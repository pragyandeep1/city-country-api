<?php

namespace App\Services;
use GuzzleHttp\Client;

class CountryService
{
    public function fetchCountryData()
    {
        $client = new Client();
        $response = $client->get('YOUR_COUNTRY_API_ENDPOINT');
        
        return json_decode($response->getBody(), true);
    }
}
