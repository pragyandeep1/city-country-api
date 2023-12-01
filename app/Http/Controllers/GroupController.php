<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\City;
use App\Models\Country;

class GroupController extends Controller
{
    public function createGroup(Request $request) {
        // Validate request data

        $group = Group::create([
            'name' => $request->input('name'),
            // Other group attributes
        ]);

        // Attach cities and countries to the group
        $group->cities()->attach($request->input('city_ids'));
        $group->countries()->attach($request->input('country_ids'));

        return redirect()->route('groups.index')->with('success', 'Group created successfully');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'selected_cities' => 'nullable|array',
            'selected_countries' => 'nullable|array',
        ]);

        // Create a new group
        $group = Group::create([
            'name' => $request->input('name'),
        ]);

        // Attach selected cities to the group
        if ($request->has('selected_cities')) {
            $selectedCities = $request->input('selected_cities');
            $cities = City::whereIn('id', $selectedCities)->get();
            $group->cities()->attach($cities);
        }

        // Attach selected countries to the group
        if ($request->has('selected_countries')) {
            $selectedCountries = $request->input('selected_countries');
            $countries = Country::whereIn('id', $selectedCountries)->get();
            $group->countries()->attach($countries);
        }

        return redirect()->route('groups.index')->with('success', 'Group created successfully');
    }

    public function getUserGroups(Request $request)
    {
        $user = $request->user(); // Get the authenticated user

        $sortingOrder = $user->sorting_order ?? 'default_sorting_criteria';

        // Fetch the user's groups
        // $userGroups = Group::where('user_id', $user->id)->with('cities', 'countries')->get();
        // $userGroups = Group::where('user_id', $user->id)->orderBy($sortingOrder)->get();

        $userGroups = Cache::remember('user_' . $user->id . '_groups', $minutes, function () use ($user) {
            return Group::where('user_id', $user->id)->get();
        });

        // Structure the response data
        $formattedGroups = $userGroups->map(function ($group) {
            return [
                'group_name' => $group->name,
                'cities' => $group->cities,
                'countries' => $group->countries,
            ];
        });

        return response()->json(['groups' => $userGroups], 200);
    }

}
