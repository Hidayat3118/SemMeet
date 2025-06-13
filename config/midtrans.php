<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Midtrans Server Key
    |--------------------------------------------------------------------------
    |
    | Ambil dari .env. Wajib diisi. Gunakan server key dari dashboard Midtrans.
    |
    */
    'server_key' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-dld95cA8j5PZ6_8cPoc-oxPh'),

    /*
    |--------------------------------------------------------------------------
    | Midtrans Client Key
    |--------------------------------------------------------------------------
    |
    | Client key digunakan di front-end (jika pakai Snap JS). Ambil dari .env.
    |
    */
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-RD3KKeI97G7BJInj'),

    /*
    |--------------------------------------------------------------------------
    | Environment
    |--------------------------------------------------------------------------
    |
    | Jika false maka akan menggunakan sandbox (testing). Jika true berarti live.
    |
    */
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),

    /*
    |--------------------------------------------------------------------------
    | Enable sanitization
    |--------------------------------------------------------------------------
    |
    | Disarankan TRUE untuk menghindari input tidak valid.
    |
    */
    'is_sanitized' => true,

    /*
    |--------------------------------------------------------------------------
    | Enable 3DS Secure
    |--------------------------------------------------------------------------
    |
    | Untuk transaksi kartu kredit. Disarankan TRUE.
    |
    */
    'is_3ds' => true,

];
