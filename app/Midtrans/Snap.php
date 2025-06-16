<?php

namespace App\Midtrans;

use App\Midtrans\ApiRequestor;
use Midtrans\Config;

class Snap
{
    public static function getSnapToken($params)
    {
        $result = self::createTransaction($params);
        return $result->token;
    }

    public static function createTransaction($params)
    {
        $endpoint = Config::getSnapBaseUrl() . '/transactions';
        return ApiRequestor::post($endpoint, Config::$serverKey, $params);
    }
}
