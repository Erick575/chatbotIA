<?php

namespace App\Helpers;

class CurrencyExchangeHelper
{
    public static function convert($from, $to, $amount)
    {
        $api = env('CURRENCY_API_KEY');   
        $string = file_get_contents("https://www.amdoren.com/api/currency.php?api_key=$api&from=$from&to=$to");
        $json = json_decode($string, true);
        return $json['amount'] * $amount;
    }
}