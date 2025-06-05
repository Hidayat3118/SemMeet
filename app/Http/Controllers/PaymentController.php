<?php

namespace App\Http\Controllers;

use App\Models\Karcis;
use App\Models\Payment;
use App\Models\Pendaftaran;
use Exception;
use Illuminate\Http\Request;
use Xendit\Invoice\Invoice;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $xendit;

    public function __construct()
    {
        Configuration::setXenditKey("xnd_development_U7wPzYWvEsghmpmcPvnBI1mHQfT34kNEaqGYjZpzOUWASdESTaaTfL4XU8ZGtc");
        $this->xendit = new InvoiceApi();
    }

    // public function bayar($id)
    // {
    //     $pendaftaran = Pendaftaran::findOrFail($id);

    //     // Cegah double payment
    //     if ($pendaftaran->payment && $pendaftaran->payment->status_pembayaran === 'paid') {
    //         return redirect()->route('pembayaran.sukses', $pendaftaran->payment->id);
    //     }

    //     // Simpan payment sebagai pending
    //     $payment = Payment::create([
    //         'jumlah_pembayaran' => $pendaftaran->seminar->harga ?? 0,
    //         'status_pembayaran' => 'pending',
    //         'pendaftaran_id' => $pendaftaran->id,
    //     ]);

    //     $params = [
    //         'external_id' => 'order-' . $payment->id,
    //         'payer_email' => $pendaftaran->peserta->user->email ?? 'dummy@email.com',
    //         'description' => 'Pembayaran Seminar: ' . $pendaftaran->seminar->judul,
    //         'amount' => $payment->jumlah_pembayaran,
    //         'success_redirect_url' => route('pembayaran.sukses', $payment->id),
    //         'failure_redirect_url' => route('pembayaran.gagal', $payment->id),
    //     ];

    //     try {
    //         $invoice = $this->xendit->createInvoice($params);
    //         return redirect($invoice['invoice_url']);
    //     } catch (Exception $e) {
    //         return back()->withErrors(['xendit' => 'Gagal membuat invoice: ' . $e->getMessage()]);
    //     }
    // }

    public function bayar($id)
{
    $pendaftaran = Pendaftaran::findOrFail($id);

    // Cek payment yang masih aktif
    $existingPayment = $pendaftaran->payment()
        ->whereIn('status_pembayaran', ['pending', 'paid'])
        ->latest()
        ->first();

    if ($existingPayment) {
        if ($existingPayment->status_pembayaran === 'completed') {
            return redirect()->route('pembayaran.sukses', $existingPayment->id);
        }

        if ($existingPayment->status_pembayaran === 'pending' && $existingPayment->invoice_url) {
            return redirect($existingPayment->invoice_url);
        }

        return redirect()->route('pembayaran.gagal', $existingPayment->id)
            ->with('info', 'Kamu masih memiliki pembayaran yang belum selesai.');
    }

    // Simpan payment baru sebagai pending
    $payment = Payment::create([
        'jumlah_pembayaran' => $pendaftaran->seminar->harga ?? 0,
        'status_pembayaran' => 'pending',
        'pendaftaran_id' => $pendaftaran->id,
    ]);

    $params = [
        'external_id' => 'order-' . $payment->id,
        'payer_email' => $pendaftaran->peserta->user->email ?? 'dummy@email.com',
        'description' => 'Pembayaran Seminar: ' . $pendaftaran->seminar->judul,
        'amount' => $payment->jumlah_pembayaran,
        'success_redirect_url' => route('pembayaran.sukses', $payment->id),
        'failure_redirect_url' => route('pembayaran.gagal', $payment->id),
    ];

    try {
            $invoice = $this->xendit->createInvoice($params);

            // Simpan invoice_url ke database
            $payment->invoice_url = $invoice['invoice_url'];
            $payment->save();

            return redirect($invoice['invoice_url']);
        } catch (Exception $e) {
            return back()->withErrors(['xendit' => 'Gagal membuat invoice: ' . $e->getMessage()]);
        }
    }

    public function sukses($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->status_pembayaran = 'completed';
        $payment->save();

        // Update status pendaftaran juga
        $payment->pendaftaran->update([
            'status' => 'paid'
        ]);

        // Generate tiket (karcis) jika belum ada
        if (!$payment->pendaftaran->karcis) {
            $uuid = Str::uuid();

            Karcis::create([
                'pendaftaran_id' => $payment->pendaftaran_id,
                'qr_code' => $uuid,
                'token' => $uuid,
                'status' => 'active',
            ]);
        }

        // Reload karcis setelah generate karena mungkin baru dibuat
        $karcis = $payment->pendaftaran->karcis()->latest()->first();

         return redirect()->route('karcis.show', $karcis->id)
        ->with('success', 'Pembayaran berhasil! Tiket kamu sudah tersedia.');
    }

    public function gagal($id)
    {
        $payment = Payment::findOrFail($id);
        return redirect()->route('home')->with('error', 'Pembayaran gagal. Silakan coba lagi.');
    }

}
