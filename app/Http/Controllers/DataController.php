<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CityAPIService;
use App\Services\CountryAPIService;
use App\Models\City;
use App\Models\Country;

class DataController extends Controller
{
    public function fetchCitiesAndCountries()
    {
        $cityService = new CityAPIService();
        $cities = $cityService->getCities();

        $countryService = new CountryAPIService();
        $countries = $countryService->getCountries();

        return [
            'cities' => $cities,
            'countries' => $countries,
        ];
    }

    public function storeCitiesAndCountries()
    {
        $cityService = new CityAPIService();
        $cities = $cityService->getCities();

        foreach ($cities as $city) {
            City::create([
                'name' => $city['name'],
                'country_code' => $city['country_code'],
                // Assign other fields accordingly
            ]);
        }

        $countryService = new CountryAPIService();
        $countries = $countryService->getCountries();

        foreach ($countries as $country) {
            Country::create([
                'name' => $country['name'],
                'code' => $country['code'],
                // Assign other fields accordingly
            ]);
        }

        return response()->json(['message' => 'Data stored successfully']);
    }
}
