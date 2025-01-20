<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\DeliveryStatus;
use App\Models\DataSensor;
use App\Models\HistorySensor;
use Carbon\Carbon;
use GuzzleHttp\Client;
class DetailCustomerController extends Controller
{

    public function detailPage($slug): View {
        $user = Auth::user();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        if($user->hasRole('administrator')) {
            $customer = Customer::where('id',$slug)->first();
            $device = $customer->device;
            $customer_id = $customer->id;
            $location = $customer->location;
            $capacity = $customer->capacity;
            $nama = $customer->name;
            $images = $customer->images;
            $maps = $device->maps;
            $email = $customer->email;
            $id_device = $device->id;
            $status_device = $device->status;
            $registration_date_device = $customer->registration_date;
            $statuses = DeliveryStatus::where('customer_id', $customer_id)->orderBy('delivery_date', 'desc')
            ->take(5)->get();

            $sensorData = HistorySensor::where('device_id', $id_device)
            ->whereMonth('timestamp', $currentMonth)
            ->whereYear('timestamp', $currentYear)
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
            $statuses = DeliveryStatus::where('customer_id', $customer_id)->orderBy('delivery_date', 'desc')
            ->take(5)->get();
           $latestPressure = DataSensor::where('device_id',  $id_device)
            ->orderBy('timestamp', 'desc')
            ->value('pressure');
            $latestTemperature = DataSensor::where('device_id',  $id_device)
            ->orderBy('timestamp', 'desc')
            ->value('temperature');
            $latestTime = DataSensor::where('device_id',  $id_device)
            ->orderBy('timestamp', 'desc')
            ->value('timestamp');
            $sensorData = HistorySensor::where('device_id', $id_device)
            ->whereMonth('timestamp', $currentMonth)
            ->whereYear('timestamp', $currentYear)
            ->orderBy('timestamp')
            ->get();

            // Mengumpulkan data nilai_sensor dan tanggal untuk chart
            $pressure = $sensorData->pluck('pressure');
            $timestamp = $sensorData->pluck('timestamp');

        return view('detail-customer', compact('customer','pressure_history','latestTime','latestTemperature','weatherData','maps','id_device','latestPressure','images','location','pressure', 'timestamp','nama', 'statuses','email','status_device','capacity','registration_date_device'));
        
          }

    }
}
