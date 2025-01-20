<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function getWeather()
    {
        $apiKey = 'YOUR_API_KEY';  // Ganti dengan API Key Anda
        $city = 'Jakarta';  // Ganti dengan lokasi yang diinginkan
        $units = 'metric';  // Gunakan 'imperial' untuk Fahrenheit

        $client = new Client();
        $response = $client->get("https://api.openweathermap.org/data/2.5/weather?q={$city}&units={$units}&appid={$apiKey}");

        $weatherData = json_decode($response->getBody(), true);

        return view('weather', compact('weatherData'));
    }
}
