<?php

namespace App\Services;

use App\Models\City;
use GuzzleHttp\Client;

class CityService
{
    /*public function fetchCityData()
    {
        $client = new Client();
        $response = $client->get('YOUR_CITY_API_ENDPOINT');
        $cities = json_decode($response->getBody(), true);
        
        foreach ($cities as $city) {
            // Save each city to the database
            City::create([
                'name' => $city['name'],
                // Include other necessary fields
            ]);
        }
        return json_decode($response->getBody(), true);
    }*/

    public function fetchCityData()
    {
        $cachedCities = Cache::remember('cached_cities', $minutes, function () {
            $client = new Client();
            $response = $client->get('YOUR_CITY_API_ENDPOINT');
            return json_decode($response->getBody(), true);
        });

        return $cachedCities;
    }
}
