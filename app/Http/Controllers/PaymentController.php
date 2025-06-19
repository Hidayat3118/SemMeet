<?php

namespace App\Http\Controllers;

use App\Models\Karcis;
use App\Models\Payment;
use App\Models\Pendaftaran;
use App\Models\voucher;
use Exception;
use Illuminate\Http\Request;
use Xendit\Invoice\Invoice;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use App\Midtrans\Snap;
use Midtrans\Config;

class PaymentController extends Controller
{
    // protected $xendit;

    // public function __construct()
    // {
    //     Configuration::setXenditKey("xnd_development_U7wPzYWvEsghmpmcPvnBI1mHQfT34kNEaqGYjZpzOUWASdESTaaTfL4XU8ZGtc");
    //     $this->xendit = new InvoiceApi();
    // }

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

    //sebelumnya
//     public function bayar($id)
// {
//     $pendaftaran = Pendaftaran::findOrFail($id);

//     // Cek payment yang masih aktif
//     $existingPayment = $pendaftaran->payment()
//         ->whereIn('status_pembayaran', ['pending', 'paid'])
//         ->latest()
//         ->first();

//     if ($existingPayment) {
//         if ($existingPayment->status_pembayaran === 'completed') {
//             return redirect()->route('pembayaran.sukses', $existingPayment->id);
//         }

//         if ($existingPayment->status_pembayaran === 'pending' && $existingPayment->invoice_url) {
//             return redirect($existingPayment->invoice_url);
//         }

//         return redirect()->route('pembayaran.gagal', $existingPayment->id)
//             ->with('info', 'Kamu masih memiliki pembayaran yang belum selesai.');
//     }

//     // Simpan payment baru sebagai pending
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
//             $invoice = $this->xendit->createInvoice($params);

//             // Simpan invoice_url ke database
//             $payment->invoice_url = $invoice['invoice_url'];
//             $payment->save();

//             return redirect($invoice['invoice_url']);
//         } catch (Exception $e) {
//             return back()->withErrors(['xendit' => 'Gagal membuat invoice: ' . $e->getMessage()]);
//         }
//     }



//voucher
// public function bayar(Request $request, $id)
// {
//     $pendaftaran = Pendaftaran::findOrFail($id);
//     $voucherCode = $request->input('code_voucher');

//     // Cek jika ada payment aktif
//     $existingPayment = $pendaftaran->payment()
//         ->whereIn('status_pembayaran', ['pending', 'completed'])
//         ->latest()
//         ->first();

//     if ($existingPayment) {
//         if ($existingPayment->status_pembayaran === 'completed') {
//             return redirect()->route('pembayaran.sukses', $existingPayment->id);
//         }

//         if ($existingPayment->status_pembayaran === 'pending' && $existingPayment->invoice_url) {
//             return redirect($existingPayment->invoice_url);
//         }

//         return redirect()->route('pembayaran.gagal', $existingPayment->id)
//             ->with('info', 'Kamu masih memiliki pembayaran yang belum selesai.');
//     }

//     $harga = $pendaftaran->seminar->harga ?? 0;
//     $diskon = 0;
//     $voucher_id = null;

//     // Validasi dan proses voucher
//     if ($voucherCode) {
//         $voucher = Voucher::where('code_voucher', $voucherCode)
//             ->where('seminar_id', $pendaftaran->seminar_id)
//             ->where('status', 'aktif')
//             ->where('tanggal_mulai', '<=', now())
//             ->where('tanggal_berakhir', '>=', now())
//             ->first();

//         if (!$voucher) {
//             return back()->withErrors(['voucher' => 'Voucher tidak valid atau tidak berlaku.']);
//         }

//         if ($voucher->penggunaan_voucher >= $voucher->maksimal_pemakaian) {
//             return back()->withErrors(['voucher' => 'Kuota voucher telah habis.']);
//         }

//         $diskon = min($voucher->diskon_harga, $harga);
//         $voucher_id = $voucher->id;
//     }

//     $totalBayar = $harga - $diskon;

//     // Simpan payment ke database
//     $payment = Payment::create([
//         'jumlah_pembayaran' => $totalBayar,
//         'status_pembayaran' => 'pending',
//         'pendaftaran_id' => $pendaftaran->id,
//         'voucher_id' => $voucher_id,
//         'diskon' => $diskon,
//     ]);

//     $params = [
//         'external_id' => 'order-' . $payment->id,
//         'payer_email' => $pendaftaran->peserta->user->email ?? 'dummy@email.com',
//         'description' => 'Pembayaran Seminar: ' . $pendaftaran->seminar->judul,
//         'amount' => $totalBayar,
//         'success_redirect_url' => route('pembayaran.sukses', $payment->id),
//         'failure_redirect_url' => route('pembayaran.gagal', $payment->id),
//     ];

//     try {
//         $invoice = $this->xendit->createInvoice($params);
//         $payment->invoice_url = $invoice['invoice_url'];
//         $payment->save();

//         // Update penggunaan voucher setelah invoice berhasil dibuat
//         if ($voucher_id) {
//             $voucher->increment('penggunaan_voucher');
//         }

//         return redirect($invoice['invoice_url']);
//     } catch (Exception $e) {
//         return back()->withErrors(['xendit' => 'Gagal membuat invoice: ' . $e->getMessage()]);
//     }
// }

// public function bayar(Request $request, $id)
// {
//     $pendaftaran = Pendaftaran::findOrFail($id);

//     $request->validate([
//         'code_voucher' => 'nullable|string|max:50',
//     ]);

//     $voucherCode = $request->input('code_voucher');

//     // Cek jika ada payment aktif
//     $existingPayment = $pendaftaran->payment()
//         ->whereIn('status_pembayaran', ['pending', 'completed'])
//         ->latest()
//         ->first();

//     if ($existingPayment) {
//         if ($existingPayment->status_pembayaran === 'completed') {
//             return redirect()->route('pembayaran.sukses', $existingPayment->id);
//         }

//         if ($existingPayment->status_pembayaran === 'pending' && $existingPayment->invoice_url) {
//             return redirect($existingPayment->invoice_url);
//         }

//         return redirect()->route('pembayaran.gagal', $existingPayment->id)
//             ->with('info', 'Kamu masih memiliki pembayaran yang belum selesai.');
//     }

//     $harga = $pendaftaran->seminar->harga ?? 0;
//     $diskon = 0;
//     $voucher_id = null;

//     // Proses voucher jika ada
//     if ($voucherCode) {
//         $voucher = Voucher::where('code_voucher', $voucherCode)
//             ->where('seminar_id', $pendaftaran->seminar_id)
//             ->where('status', 'active')
//             ->where('tanggal_mulai', '<=', now())
//             ->where('tanggal_berakhir', '>=', now())
//             ->whereColumn('penggunaan_voucher', '<', 'maksimal_pemakaian')
//             ->first();

//         if (!$voucher) {
//             return back()->withErrors(['code_voucher' => 'Kode voucher tidak valid atau kuota habis.']);
//         }

//         $diskon = min($voucher->diskon_harga, $harga);
//         $voucher_id = $voucher->id;
//     }

//     $totalBayar = max(0, $harga - $diskon); // jaga-jaga jika diskon > harga

//     // Simpan payment ke database
//     $payment = Payment::create([
//         'jumlah_pembayaran' => $totalBayar,
//         'status_pembayaran' => 'pending',
//         'pendaftaran_id' => $pendaftaran->id,
//         'voucher_id' => $voucher_id,
//         'diskon' => $diskon,
//     ]);

//     $params = [
//         'external_id' => 'order-' . $payment->id,
//         'payer_email' => $pendaftaran->peserta->user->email ?? 'dummy@email.com',
//         'description' => 'Pembayaran Seminar: ' . $pendaftaran->seminar->judul,
//         'amount' => $totalBayar,
//         'success_redirect_url' => route('pembayaran.sukses', $payment->id),
//         'failure_redirect_url' => route('pembayaran.gagal', $payment->id),
//     ];

//     try {
//         $invoice = $this->xendit->createInvoice($params);
//         $payment->invoice_url = $invoice['invoice_url'];
//         $payment->save();

//         // Jika ada voucher, update penggunaan hanya setelah invoice berhasil dibuat
//         if ($voucher_id) {
//             $voucher->increment('penggunaan_voucher');
//         }

//         return redirect($invoice['invoice_url']);
//     } catch (Exception $e) {
//         return back()->withErrors(['xendit' => 'Gagal membuat invoice: ' . $e->getMessage()]);
//     }
// }


//     public function sukses($id)
//     {
//         $payment = Payment::findOrFail($id);

//         if ($payment->status_pembayaran !== 'completed') {
//             $payment->status_pembayaran = 'completed';
//             $payment->save();

//             $payment->pendaftaran->update(['status' => 'paid']);

//             if (!$payment->pendaftaran->karcis) {
//                 $uuid = Str::uuid()->toString();

//                 Karcis::create([
//                     'pendaftaran_id' => $payment->pendaftaran_id,
//                     'qr_code' => $uuid,
//                     'token' => $uuid,
//                     'status' => 'active',
//                 ]);
//             }
//         }

//         $karcis = $payment->pendaftaran->karcis()->latest()->first();

//         return redirect()->route('karcis.show', $karcis->id)
//             ->with('success', 'Pembayaran berhasil! Tiket kamu sudah tersedia.');
//     }

//      public function gagal($id)
//     {
//         return redirect()->route('home')->with('error', 'Pembayaran gagal. Silakan coba lagi.');
//     }

    //sebelumnya
    // public function sukses($id)
    // {
    //     $payment = Payment::findOrFail($id);
    //     $payment->status_pembayaran = 'completed';
    //     $payment->save();

    //     // Update status pendaftaran juga
    //     $payment->pendaftaran->update([
    //         'status' => 'paid'
    //     ]);

    //     // Generate tiket (karcis) jika belum ada
    //     if (!$payment->pendaftaran->karcis) {
    //         $uuid = Str::uuid();

    //         Karcis::create([
    //             'pendaftaran_id' => $payment->pendaftaran_id,
    //             'qr_code' => $uuid,
    //             'token' => $uuid,
    //             'status' => 'active',
    //         ]);
    //     }

    //     // Reload karcis setelah generate karena mungkin baru dibuat
    //     $karcis = $payment->pendaftaran->karcis()->latest()->first();

    //      return redirect()->route('karcis.show', $karcis->id)
    //     ->with('success', 'Pembayaran berhasil! Tiket kamu sudah tersedia.');
    // }

    //sebelumnya
    // public function gagal($id)
    // {
    //     $payment = Payment::findOrFail($id);
    //     return redirect()->route('home')->with('error', 'Pembayaran gagal. Silakan coba lagi.');
    // }

//     public function cekVoucher(Request $request)
// {
//     $request->validate([
//         'code_voucher' => 'required|string',
//         'seminar_id' => 'required|integer',
//     ]);

//     $voucher = Voucher::where('code_voucher', $request->voucher_code)
//         ->where('seminar_id', $request->seminar_id)
//         ->where('status', 'aktif')
//         ->where('tanggal_mulai', '<=', now())
//         ->where('tanggal_berakhir', '>=', now())
//         ->first();

//     if (!$voucher) {
//         return response()->json(['success' => false, 'message' => 'Voucher tidak ditemukan atau sudah tidak berlaku.']);
//     }

//     if ($voucher->penggunaan_voucher >= $voucher->maksimal_pemakaian) {
//         return response()->json(['success' => false, 'message' => 'Kuota voucher telah habis.']);
//     }

//     return response()->json([
//         'success' => true,
//         'diskon' => $voucher->diskon_harga,
//     ]);
// }

//midtrans fix
// public function bayar(Request $request, $id)
// {
//     $pendaftaran = Pendaftaran::findOrFail($id);

//     $request->validate([
//         'code_voucher' => 'nullable|string|max:50',
//     ]);

//     $voucherCode = $request->input('code_voucher');

//     // Cek payment aktif
//     $existingPayment = $pendaftaran->payment()
//         ->whereIn('status_pembayaran', ['pending', 'completed'])
//         ->latest()->first();

//     if ($existingPayment) {
//         if ($existingPayment->status_pembayaran === 'completed') {
//             return response()->json(['redirect' => route('pembayaran.sukses', $existingPayment->id)]);
//         }

//         if ($existingPayment->status_pembayaran === 'pending' && $existingPayment->snap_token) {
//             return response()->json(['snap_token' => $existingPayment->snap_token]);
//         }

//         return response()->json([
//             'error' => 'Kamu masih memiliki pembayaran yang belum selesai.',
//             'redirect' => route('pembayaran.gagal', $existingPayment->id),
//         ]);
//     }

//     $harga = $pendaftaran->seminar->harga ?? 0;
//     $diskon = 0;
//     $voucher_id = null;

//     if ($voucherCode) {
//         $voucher = Voucher::where('code_voucher', $voucherCode)
//             ->where('seminar_id', $pendaftaran->seminar_id)
//             ->where('status', 'active')
//             ->where('tanggal_mulai', '<=', now())
//             ->where('tanggal_berakhir', '>=', now())
//             ->whereColumn('penggunaan_voucher', '<', 'maksimal_pemakaian')
//             ->first();

//         if (!$voucher) {
//             return response()->json(['error' => 'Kode voucher tidak valid atau kuota habis.'], 422);
//         }

//         $diskon = min($voucher->diskon_harga, $harga);
//         $voucher_id = $voucher->id;
//     }

//     $totalBayar = max(0, $harga - $diskon);

//     // Simpan ke DB
//     $payment = Payment::create([
//         'jumlah_pembayaran' => $totalBayar,
//         'status_pembayaran' => 'pending',
//         'pendaftaran_id' => $pendaftaran->id,
//         'voucher_id' => $voucher_id,
//         'diskon' => $diskon,
//     ]);

//     // Konfigurasi Midtrans
//     Config::$serverKey = config('midtrans.server_key');
//     Config::$isProduction = config('midtrans.is_production');
//     Config::$isSanitized = true;
//     Config::$is3ds = true;

//     $snapPayload = [
//         'transaction_details' => [
//             'order_id' => 'SEM-' . $payment->id,
//             'gross_amount' => $totalBayar,
//         ],
//         'customer_details' => [
//             'first_name' => $pendaftaran->peserta->user->name,
//             'email' => $pendaftaran->peserta->user->email,
//         ],
//         'callbacks' => [
//             'finish' => route('pembayaran.sukses', $payment->id),
//         ],
//     ];

//     try {
//          \Midtrans\Config::$curlOptions[CURLOPT_SSL_VERIFYPEER] = false;
//     \Midtrans\Config::$curlOptions[CURLOPT_SSL_VERIFYHOST] = false;
//         $snapToken = Snap::getSnapToken($snapPayload);
//         $payment->snap_token = $snapToken;
//         $payment->save();

//         if ($voucher_id) {
//             $voucher->increment('penggunaan_voucher');
//         }

//         return response()->json(['snap_token' => $snapToken]);
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Gagal membuat Snap Token: ' . $e->getMessage()], 500);
//     }
// }

// Auto Update
public function bayar(Request $request, $id)
{
    $pendaftaran = Pendaftaran::findOrFail($id);

    $request->validate([
        'code_voucher' => 'nullable|string|max:50',
    ]);

    $voucherCode = $request->input('code_voucher');
    $harga = $pendaftaran->seminar->harga ?? 0;
    $diskon = 0;
    $voucher_id = null;
    $voucher = null;

    // Cek voucher jika ada
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

    // Cek apakah sudah ada payment pending yang sesuai (jumlah & voucher)
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

    // Buat payment baru
    $payment = Payment::create([
        'jumlah_pembayaran' => $totalBayar,
        'status_pembayaran' => 'pending',
        'pendaftaran_id' => $pendaftaran->id,
        'voucher_id' => $voucher_id,
        'diskon' => $diskon,
    ]);

    // Konfigurasi Midtrans
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = config('midtrans.is_production');
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;
    \Midtrans\Config::$curlOptions[CURLOPT_SSL_VERIFYPEER] = false;
    \Midtrans\Config::$curlOptions[CURLOPT_SSL_VERIFYHOST] = false;

    $snapPayload = [
        'transaction_details' => [
            'order_id' => 'SEM-' . $payment->id,
            'gross_amount' => $totalBayar,
        ],
        'customer_details' => [
            'first_name' => $pendaftaran->peserta->user->name,
            'email' => $pendaftaran->peserta->user->email,
        ],
        'callbacks' => [
            'finish' => route('pembayaran.sukses', $payment->id),
        ],
    ];

    try {
        $snapToken = \Midtrans\Snap::getSnapToken($snapPayload);
        $payment->snap_token = $snapToken;
        $payment->save();

        if ($voucher_id && $voucher) {
            $voucher->increment('penggunaan_voucher');
        }

        return response()->json(['snap_token' => $snapToken]);
    } catch (\Exception $e) {
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

    // Hapus payment gagal
    $payment->delete();

    // Redirect ke halaman pendaftaran ulang
    return redirect()->route('pendaftaran.show', $pendaftaranId)
        ->with('error', 'Pembayaran sebelumnya gagal dan telah dihapus. Silakan coba bayar lagi.');
}


}
