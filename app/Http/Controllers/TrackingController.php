<?php

namespace App\Http\Controllers;

use App\Models\BufferKendaraan;
use App\Models\Tracking;
use Illuminate\Http\Request;


class TrackingController extends Controller
{

    public function index()
    {
        $minpressuresensor = BufferKendaraan::join('kendaraans', 'buffer_kendaraans.kendaraan_id', '=', 'kendaraans.id')
        ->select('buffer_kendaraans.*', 'kendaraans.*')
        ->get();
        $centrepoint = env('APP_POINT');
        return view('tracking.index', compact('centrepoint','minpressuresensor'));
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
