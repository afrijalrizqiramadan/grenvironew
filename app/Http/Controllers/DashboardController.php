<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\DeliveryStatus;
use App\Models\HistorySensor;
use App\Models\Device;
use App\Models\DataSensor;
use Laravolt\Indonesia\Models\District;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use GuzzleHttp\Client;

class DashboardController extends Controller
{

    public function dashboardPage(Request $request): View {
        // $user = $request->user();
        $user = Auth::user();
        
        if($user->hasRole('administrator')) {
            $user = Auth::user(); // Mendapatkan pengguna yang sedang login
            $customerCount = Customer::count(); // Menghitung jumlah data customer
            $averagePressure = DataSensor::avg('pressure');
            $lowPressureCount = DataSensor::where('pressure', '<', 20)->count();
                
            $minpressuresensor = DataSensor::join('devices', 'data_sensors.device_id', '=', 'devices.id')
            ->join('customers', 'devices.id', '=', 'customers.device_id')
            ->join('indonesia_districts', 'customers.district', '=', 'indonesia_districts.id') // Join dengan tabel districts
            ->select('data_sensors.*', 'customers.*', 'indonesia_districts.name as district_name')
            ->get();

            $countDeliveries = DeliveryStatus::where('status', 'Selesai')
            ->whereYear('delivery_date', now()->year)
            ->whereMonth('delivery_date', now()->month)
            ->count();

              return view('dashboard-administrator', compact('countDeliveries','customerCount','lowPressureCount','averagePressure', 'minpressuresensor'));
     }
        elseif($user->hasRole('customer')) {
            $user = Auth::user(); // Mendapatkan pengguna yang sedang login
            $customer = $user->customer; // Mendapatkan data customer yang terkait dengan pengguna
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

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
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

        return view('dashboard-customer', compact('latestTime','weatherData','maps','id_device','latestPressure','images','location','pressure', 'timestamp','nama', 'statuses','email','status_device','capacity','registration_date_device'));
        }
        elseif($user->hasRole('technician')) {

            $deviceData = Device::get();
            $user = Auth::user(); // Mendapatkan pengguna yang sedang login
            $customerCount = Customer::count(); // Menghitung jumlah data customer
            $averagePressure = DataSensor::avg('pressure');
            $lowPressureCount = DataSensor::where('pressure', '<', 20)->count();

            $minpressuresensor = DataSensor::join('devices', 'data_sensors.device_id', '=', 'devices.id')
            ->join('customers', 'devices.id', '=', 'customers.device_id')
            ->join('indonesia_districts', 'customers.district', '=', 'indonesia_districts.id') // Join dengan tabel districts
            ->select('data_sensors.*', 'customers.*', 'indonesia_districts.name as district_name')
            ->get();

            $countDeliveries = DeliveryStatus::where('status', 'Selesai')
            ->whereYear('delivery_date', now()->year)
            ->whereMonth('delivery_date', now()->month)
            ->count();

              return view('dashboard-technician', compact('deviceData','countDeliveries','lowPressureCount','customerCount','averagePressure', 'minpressuresensor'));
         }
    }

    public function getSensorData(Request $request)
    {
        // Ambil parameter `id_device`
        $id_device = $request->input('id_device');
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Query data sensor
        $sensorData = HistorySensor::where('device_id', $id_device)
            ->whereMonth('timestamp', $currentMonth)
            ->whereYear('timestamp', $currentYear)
            ->orderBy('timestamp')
            ->get();

        // Format data untuk ApexCharts
        $formattedData = $sensorData->map(function ($data) {
            return [
                'x' => $data->timestamp, // Timestamp sebagai sumbu X
                'y' => $data->value      // Nilai sensor sebagai sumbu Y
            ];
        });

        // Return dalam format JSON
        return response()->json($formattedData);
    }
    
    public function getPressureData($id_device)
    {
        $data = DataSensor::where('device_id', $id_device)->latest()->first(['pressure', 'timestamp']);
        return response()->json($data);
    }

    public function getTemperatureData($id_device)
    {
        $data = DataSensor::where('device_id', $id_device)->latest()->first(['temperature', 'timestamp']);
        return response()->json($data);
    }

}
