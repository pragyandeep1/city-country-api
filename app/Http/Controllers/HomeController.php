<?php
use App\Models\City;
use App\Models\Country;

class HomeController extends Controller
{
    public function index()
    {
        $cities = City::all();
        $countries = Country::all();

        return view('cities_countries')->with(compact('cities', 'countries'));
    }
}
