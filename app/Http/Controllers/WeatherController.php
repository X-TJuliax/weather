<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather($city)
    {
        $apiKey = env('OPENWEATHER_API_KEY');
        $response = Http::get("http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric");

        if ($response->successful()){
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'City not found'], 404);
        }
    }
}
