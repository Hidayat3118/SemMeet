<?php

namespace App\Http\Controllers;

use App\Models\voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function cek(Request $request)
{
    $request->validate([
        'code_voucher' => 'nullable|string',
        'seminar_id' => 'required|exists:seminars,id'
    ]);

     $voucher = voucher::where('code_voucher', $request->voucher_code)
        ->where('seminar_id', $request->seminar_id)
        ->where('status', 'active')
        ->where('tanggal_mulai', '<=', now())
        ->where('tanggal_berakhir', '>=', now())
        ->whereColumn('penggunaan_voucher', '<', 'maksimal_pemakaian')
        ->first();

    if (!$voucher) {
        return response()->json([
            'success' => false,
            'message' => 'Kode voucher tidak valid atau telah habis.'
        ]);
    }

    return response()->json([
        'success' => true,
        'diskon' => $voucher->diskon_harga,
        'message' => 'Voucher berhasil diterapkan.'
    ]);
}

}
