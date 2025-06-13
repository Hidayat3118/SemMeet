<?php

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-dld95cA8j5PZ6_8cPoc-oxPh';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

$params = [
    'transaction_details' => [
        'order_id' => rand(),
        'gross_amount' => 10000,
    ],
    'customer_details' => [
        'first_name' => 'budi',
        'last_name' => 'pratama',
        'email' => 'budi.pra@example.com',
        'phone' => '08111222333',
    ],
];
\Midtrans\Config::$curlOptions[CURLOPT_SSL_VERIFYPEER] = false;
\Midtrans\Config::$curlOptions[CURLOPT_SSL_VERIFYHOST] = false;
$snapToken = \Midtrans\Snap::getSnapToken($params);
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.stg.midtrans.com/snap/snap.js"
        data-client-key="SET_YOUR_CLIENT_KEY_HERE"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
</head>

<body>
    <button id="pay-button">Pay!</button>

    <!-- @TODO: You can add the desired ID as a reference for the embedId parameter. -->
    <div id="snap-container"></div>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
            // Also, use the embedId that you defined in the div above, here.
            window.snap.embed('YOUR_SNAP_TOKEN', {
                embedId: 'snap-container'
            });
        });
    </script>
</body>

</html>
