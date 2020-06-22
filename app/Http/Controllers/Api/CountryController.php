<?php

namespace App\Http\Controllers\Api;

use App\Country;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::where('name', 'like', "%{$request['query']}%")->paginate();

        return CountryResource::collection($countries);
    }
}
