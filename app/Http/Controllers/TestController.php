<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class TestController extends Controller
{
     public function testMidtrans()
    {
        try {
            // Konfigurasi Midtrans
           \Midtrans\Config::$serverKey = config('midtrans.server_key');
\Midtrans\Config::$isProduction = config('midtrans.is_production');
\Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
\Midtrans\Config::$is3ds = config('midtrans.is_3ds');

             // Tambahkan ini untuk menghindari error SSL saat testing
    Config::$curlOptions[CURLOPT_SSL_VERIFYPEER] = false;

            // Data dummy transaksi
            $params = [
                'transaction_details' => [
                    'order_id' => uniqid(),
                    'gross_amount' => 50000,
                ],
                'customer_details' => [
                    'first_name' => 'Coba',
                    'email' => 'coba@example.com',
                ],
            ];

//             dd([
//     'server_key' => config('midtrans.server_key'),
//     'is_production' => config('midtrans.is_production'),
//     'params' => $params
// ]);
            
            // Coba ambil Snap Token
            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'success' => true,
                'token' => $snapToken,
                'raw_response' => $params
            ]);
        } catch (\Exception $e) {
            // dd($e); 
    // Cek apakah respons dari Midtrans bisa di-decode
    $message = $e->getMessage();
    $decoded = json_decode($message, true);
    
    if (json_last_error() === JSON_ERROR_NONE && isset($decoded['status_message'])) {
        $message = $decoded['status_message'];
    }

    return response()->json([
        'success' => false,
        'message' => $message
    ], 500);
}
    }
}
