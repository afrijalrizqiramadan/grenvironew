<?php

namespace App\Http\Controllers;

use App\Models\CentrePoint;
use App\Models\DataSensorKendaraan;
use App\Models\Tracking;
use Illuminate\Http\Request;


class TrackingController extends Controller
{

    public function index()
    {
        $minpressuresensor = DataSensorKendaraan::join('devices', 'data_sensor_kendaraans.device_id', '=', 'devices.id')
        ->join('kendaraans', 'devices.id', '=', 'kendaraans.device_id')
        ->select('data_sensor_kendaraans.*', 'kendaraans.*')
        ->get();
        $centrepoint = CentrePoint::get()->first();
        return view('tracking.index', compact('centrepoint','minpressuresensor'));
    }

    public function store(Request $request)
    {
        $tracking = Tracking::create([
            'device_id' => $request->device_id,
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
