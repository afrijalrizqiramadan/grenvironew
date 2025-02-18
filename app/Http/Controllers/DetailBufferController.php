<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Trip;
use App\Models\BufferCustomer;
use App\Models\BufferCustomerHistories;
use App\Models\BufferCustomerHistory;
use App\Models\BufferCustomersHistory;
use App\Models\TripDestination;
use Carbon\Carbon;
use GuzzleHttp\Client;
class DetailBufferController extends Controller
{

    public function detailPage($id): View {
        $user = Auth::user();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        if($user->hasRole('administrator')) {
            $customer = Customer::where('id',$id)->first();
            $buffercustomer = $customer->buffercustomer;
            $customer_id = $customer->id;
            $location = $customer->location;
            $capacity = $customer->capacity;
            $nama = $customer->name;
            $images = $customer->images;
            $email = $customer->email;
            $registration_date_device = $customer->registration_date;
            $statuses = TripDestination::where('buffer_customers', $id)->orderBy('created_at', 'desc')
            ->take(5)->get();

            $sensorData = BufferCustomersHistory::where('buffer_id', $id)
            ->whereDate('timestamp', Carbon::today())
            ->orderBy('timestamp')
            ->get();

            // Mengumpulkan data nilai_sensor dan tanggal untuk chart
            $pressure_history = [];
            $pressure_history['data'] = $sensorData->pluck('pressure')->toArray();
            $pressure_history['categories'] = $sensorData->pluck('timestamp')->map(function($date) {
                return \Carbon\Carbon::parse($date)->translatedFormat('d F Y H:i:s');
            })->toArray();
        $apiKey = '50833fc817cd790ad28ff60cf080111e';  // Ganti dengan API Key Anda
        $city = 'Malang';  // Ganti dengan lokasi yang diinginkan
        $units = 'metric';  // Gunakan 'imperial' untuk Fahrenheit
        $client = new Client();
        $response = $client->get("https://api.openweathermap.org/data/2.5/weather?q={$city}&units={$units}&appid={$apiKey}");

        $weatherData = json_decode($response->getBody(), true);

            $registration_date_device = $customer->registration_date;
            $statuses = TripDestination::where('buffer_customers', $id)->orderBy('created_at', 'desc')
            ->take(5)->get();
           $latestPressure = BufferCustomer::where('id',  $id)
            ->orderBy('timestamp', 'desc')
            ->value('pressure');
            $latestTemperature = BufferCustomer::where('id',  $id)
            ->orderBy('timestamp', 'desc')
            ->value('temperature');
            $latestTime = BufferCustomer::where('id',  $id)
            ->orderBy('timestamp', 'desc')
            ->value('timestamp');
            $sensorData = BufferCustomersHistory::where('id', $id)
            ->whereMonth('timestamp', $currentMonth)
            ->whereYear('timestamp', $currentYear)
            ->orderBy('timestamp')
            ->get();

            // Mengumpulkan data nilai_sensor dan tanggal untuk chart
            $pressure = $sensorData->pluck('pressure');
            $timestamp = $sensorData->pluck('timestamp');

        return view('detail-buffer', compact('customer','pressure_history','latestTime','latestTemperature','weatherData','latestPressure','images','location','pressure', 'timestamp','nama', 'statuses','email','capacity','registration_date_device'));
        
          }

    }
}
