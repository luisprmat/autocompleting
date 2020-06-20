<?php

namespace App\Http\Controllers\Api;

use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        return Country::all()->pluck('name');
    }

    public function show($name)
    {
        return Country::where('name', $name)->first();
    }
}
