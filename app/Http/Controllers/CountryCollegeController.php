<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\College;
use Illuminate\Support\Facades\Log;

class CountryCollegeController extends Controller
{
     /**
     * Retrieve countries data
     *
     * @return void
     */
    public function getCountries()
    {
        $data = Country::get();
        return response()->json($data);
    }
    /**
     * Retrieve Colleges data
     *
     */
    public function getColleges(Request $request)
    {
        Log::info($request->all());
        $data = College::where('country_id', $request->country_id)->get();
        Log::info($data);
        return response()->json($data);
    }
}
