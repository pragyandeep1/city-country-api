<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Population;

class CountrySateCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $country = Country::create(['name' => 'United States']);
  
        $state = State::create(['country_id' => $country->id, 'name' => 'Florida']);
  
        $miami = City::create(['state_id' => $state->id, 'name' => 'Miami']);
        $tampa = City::create(['state_id' => $state->id, 'name' => 'Tampa']);

        Population::create(['city_id' => $miami->id, 'population' => '1500000']);
        Population::create(['city_id' => $tampa->id, 'population' => '1200000']);

        $country = Country::create(['name' => 'India']);
  
        $state = State::create(['country_id' => $country->id, 'name' => 'Gujarat']);
  
        $rajkot = City::create(['state_id' => $state->id, 'name' => 'Rajkot']);
        $surat = City::create(['state_id' => $state->id, 'name' => 'Surat']);

        Population::create(['city_id' => $rajkot->id, 'population' => '800000']);
        Population::create(['city_id' => $surat->id, 'population' => '1200000']);
    }
}
