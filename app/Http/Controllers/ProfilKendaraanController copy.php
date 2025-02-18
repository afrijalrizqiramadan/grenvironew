<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\BufferCustomerKendaraan;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\Trip;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;

class ProfilKendaraanController extends Controller
{

    public function detailPage($id): View {
        $user = Auth::user();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        if($user->hasRole('administrator')) {
            $kendaraan = Kendaraan::where('id',$id)->first();
            $device = $kendaraan->device;
            $dataSensor = BufferCustomerKendaraan::where('buffer_id', $device->id)->latest()->first();
            $kendaraan_id = $kendaraan->id;
            $location = $kendaraan->location;
            $capacity = $kendaraan->capacity;
            $nama = $kendaraan->name;
            $images = $kendaraan->images;
            $email = $kendaraan->email;
            $id_device = $device->id;
            $status_device = $device->status;
            $registration_date_device = $kendaraan->registration_date;
            $statuses = Trip::join('customers', 'delivery_status.customer_id', '=', 'customers.id')
            ->where('delivery_status.kendaraan_id', $kendaraan_id)
            ->orderBy('delivery_status.delivery_date', 'desc')
            ->select('delivery_status.*', 'customers.location as location')
            ->take(5)
            ->get();
            $lokasi = $this->getLocationInfo($dataSensor->latitude, $dataSensor->longitude);
            
            $sensorData = Tracking::where('buffer_id', $id_device)
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

         
           $latestPressure = Tracking::where('buffer_id',  $id_device)
            ->orderBy('timestamp', 'desc')
            ->value('pressure');
        
            $latestTime = Tracking::where('buffer_id',  $id_device)
            ->orderBy('timestamp', 'desc')
            ->value('timestamp');
            $sensorData = Tracking::where('buffer_id', $id_device)
            ->whereMonth('timestamp', $currentMonth)
            ->whereYear('timestamp', $currentYear)
            ->orderBy('timestamp')
            ->get();

            // Mengumpulkan data nilai_sensor dan tanggal untuk chart
            $pressure = $sensorData->pluck('pressure');
            $timestamp = $sensorData->pluck('timestamp');

        return view('profilkendaraan', compact('dataSensor','kendaraan','lokasi','pressure_history','latestTime','weatherData','id_device','latestPressure','images','location','pressure', 'timestamp','nama', 'statuses','email','status_device','capacity','registration_date_device'));
        
          }

    }

    function getLocationInfo($latitude, $longitude)
{
    $url = "https://nominatim.openstreetmap.org/reverse";
    
    $response = Http::withHeaders([
        'User-Agent' => 'MyLaravelApp/1.0 (aiyothings@gmail.com)'
    ])->get($url, [
        'format' => 'jsonv2',
        'lat' => $latitude,
        'lon' => $longitude
    ]);
    if ($response->successful()) {
        $data = $response->json();

        return [
            'kecamatan' => $data['address']['village'],
            'kabupaten' => $data['address']['county'] ?? $data['address']['city'] ?? null,
            'provinsi'  => $data['address']['state'] ?? null,
            'negara'    => $data['address']['country'] ?? null
        ];
    }

    return null;
}
    public function store(Request $request)
    {
        $tracking = Tracking::create([
            'buffer_id' => $request->buffer_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'pressure' => $request->pressure,
        ]);

        return response()->json(['message' => 'Data saved successfully', 'data' => $tracking]);
    }

    // Ambil data lokasi terbaru
    public function latest()
    {    
        return response()->json(Tracking::latest()->get());
        // return response()->json(Tracking::whereDate('created_at', now()->toDateString())->get());
    }
}
