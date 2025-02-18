<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Trip;
use App\Models\BufferCustomer;
use App\Models\BufferCustomerHistories;
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
            $id_buffercustomer = $buffercustomer->id;
            $status_buffercustomer = $buffercustomer->status;
            $registration_date_device = $customer->registration_date;
            $statuses = Trip::where('customer_id', $customer_id)->orderBy('delivery_date', 'desc')
            ->take(5)->get();

            $sensorData = BufferCustomerHistories::where('buffer_id', $id_buffercustomer)
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
            $statuses = Trip::where('customer_id', $customer_id)->orderBy('delivery_date', 'desc')
            ->take(5)->get();
           $latestPressure = BufferCustomer::where('buffer_id',  $id_buffercustomer)
            ->orderBy('timestamp', 'desc')
            ->value('pressure');
            $latestTemperature = BufferCustomer::where('buffer_id',  $id_buffercustomer)
            ->orderBy('timestamp', 'desc')
            ->value('temperature');
            $latestTime = BufferCustomer::where('buffer_id',  $id_buffercustomer)
            ->orderBy('timestamp', 'desc')
            ->value('timestamp');
            $sensorData = BufferCustomerHistories::where('buffer_id', $id_buffercustomer)
            ->whereMonth('timestamp', $currentMonth)
            ->whereYear('timestamp', $currentYear)
            ->orderBy('timestamp')
            ->get();

            // Mengumpulkan data nilai_sensor dan tanggal untuk chart
            $pressure = $sensorData->pluck('pressure');
            $timestamp = $sensorData->pluck('timestamp');

        return view('detail-customer', compact('customer','pressure_history','latestTime','latestTemperature','weatherData','id_device','latestPressure','images','location','pressure', 'timestamp','nama', 'statuses','email','status_device','capacity','registration_date_device'));
        
          }

    }
}
