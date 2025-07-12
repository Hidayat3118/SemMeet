<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Karcis;
use App\Models\Payment;
use App\Models\Pendaftaran;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Midtrans\Snap;

class PaymentController extends Controller
{
    public function bayar(Request $request, $id)
    {
        // Tambahkan CSP header
        header("Content-Security-Policy: script-src 'self' 'unsafe-eval' 'unsafe-inline' https://app.sandbox.midtrans.com https://*.midtrans.com https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://code.jquery.com; object-src 'none';");

        $pendaftaran = Pendaftaran::findOrFail($id);

        $request->validate([
            'code_voucher' => 'nullable|string|max:50',
        ]);

        $voucherCode = $request->input('code_voucher');
        $harga = $pendaftaran->seminar->harga ?? 0;
        $diskon = 0;
        $voucher_id = null;
        $voucher = null;

        if ($voucherCode) {
            $voucher = Voucher::where('code_voucher', $voucherCode)
                ->where('seminar_id', $pendaftaran->seminar_id)
                ->where('status', 'active')
                ->where('tanggal_mulai', '<=', now())
                ->where('tanggal_berakhir', '>=', now())
                ->whereColumn('penggunaan_voucher', '<', 'maksimal_pemakaian')
                ->first();

            if (!$voucher) {
                return response()->json(['error' => 'Kode voucher tidak valid atau kuota habis.'], 422);
            }

            $diskon = min($voucher->diskon_harga, $harga);
            $voucher_id = $voucher->id;
        }

        $totalBayar = max(0, $harga - $diskon);

        $existingPayment = $pendaftaran->payment()
            ->where('status_pembayaran', 'pending')
            ->orderByDesc('created_at')
            ->get()
            ->first(function ($payment) use ($totalBayar, $voucher_id) {
                return $payment->jumlah_pembayaran == $totalBayar &&
                    $payment->voucher_id == $voucher_id &&
                    $payment->snap_token;
            });

        if ($existingPayment) {
            return response()->json(['snap_token' => $existingPayment->snap_token]);
        }

        $payment = Payment::create([
            'jumlah_pembayaran' => $totalBayar,
            'status_pembayaran' => 'pending',
            'pendaftaran_id' => $pendaftaran->id,
            'voucher_id' => $voucher_id,
            'diskon' => $diskon,
        ]);

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        \Midtrans\Config::$curlOptions[CURLOPT_SSL_VERIFYPEER] = false;
        \Midtrans\Config::$curlOptions[CURLOPT_SSL_VERIFYHOST] = false;

        $snapPayload = [
            'transaction_details' => [
                'order_id' => 'SEM-' . $payment->id . '-' . time(),
                'gross_amount' => max(1000, $totalBayar),
            ],
            'customer_details' => [
                'first_name' => $pendaftaran->peserta->user->name ?? 'Guest',
                'email' => $pendaftaran->peserta->user->email ?? 'default@email.com',
            ],
            'callbacks' => [
                'finish' => route('pembayaran.sukses', $payment->id),
            ],
        ];

        Log::debug('Payload Midtrans', ['payload' => $snapPayload]);

        try {
            $snapToken = Snap::getSnapToken($snapPayload);
            Log::info('Snap response', ['response' => $snapToken]);

            $payment->snap_token = $snapToken;
            $payment->save();

            if ($voucher_id && $voucher) {
                $voucher->increment('penggunaan_voucher');
            }

            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            Log::error('Gagal Snap', ['message' => $e->getMessage()]);
            return response()->json([
                'error' => 'Gagal membuat Snap Token: ' . $e->getMessage()
            ], 500);
        }
    }

    public function sukses($id)
    {
        $payment = Payment::findOrFail($id);

        if ($payment->status_pembayaran !== 'completed') {
            $payment->status_pembayaran = 'completed';
            $payment->save();

            $payment->pendaftaran->update(['status' => 'paid']);

            if (!$payment->pendaftaran->karcis) {
                $uuid = Str::uuid()->toString();
                Karcis::create([
                    'pendaftaran_id' => $payment->pendaftaran_id,
                    'qr_code' => $uuid,
                    'token' => $uuid,
                    'status' => 'active',
                ]);
            }
        }

        $karcis = $payment->pendaftaran->karcis()->latest()->first();

        return redirect()->route('karcis.show', $karcis->id)
            ->with('success', 'Pembayaran berhasil! Tiket kamu sudah tersedia.');
    }

    public function gagal($id)
    {
        $payment = Payment::with('pendaftaran.seminar')->findOrFail($id);
        return view('page.pembayaran-gagal', compact('payment'));
    }

    public function hapusDanUlang($id)
    {
        $payment = Payment::with('pendaftaran')->findOrFail($id);
        $pendaftaranId = $payment->pendaftaran_id;

        $payment->delete();

        return redirect()->route('pendaftaran.show', $pendaftaranId)
            ->with('error', 'Pembayaran sebelumnya gagal dan telah dihapus. Silakan coba bayar lagi.');
    }
}
