<?php
namespace App\Service;

use Illuminate\Support\Facades\Http;


class CurrencyConverter{

    private const CURRENCY_API_URL = 'https://free.currconv.com/api/v7/convert';

    public function getUsdRate()

    {
        $apiKey = env('CURRENCY_CONVERTER_API_KEY');

        $query = [
            'q' => 'EUR_USD',
            'compact' => 'ultra',
            'apiKey' => $apiKey,
        ];

        $response = Http::get(self::CURRENCY_API_URL, $query);

        $responseBody = json_decode($response->body(), true);

        foreach ($responseBody as $value){
             return $value;
        }
    }


    public function convertToUsd($priceInEur)
    {

        $rate = $this->getUsdRate();

        return  round($priceInEur * $rate,2) ;

    }
}

