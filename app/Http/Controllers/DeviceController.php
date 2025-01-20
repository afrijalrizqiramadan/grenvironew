<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    public function update(Request $request)
    {
        // Validasi `api_key`
        $apiKey = $request->input('api_key');
        if ($apiKey !== env('API_KEY')) {
            return response()->json(['error' => 'Invalid API key'], 403);
        }

        // Validasi data lainnya
        $validator = Validator::make($request->all(), [
            'device_id' => 'required|string',
            'uptime' => 'required|numeric',
            'memory' => 'required|numeric',
            'lastupdate' => 'required|date',
            'temperature' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Ambil data yang telah divalidasi kecuali `api_key`
        $data = $validator->validated();

        // Update data di tabel devices berdasarkan device_id
        $device = Device::where('id', $data['device_id'])->first();
        if ($device) {
            $device->uptime = $data['uptime'];
            $device->memory = $data['memory'];
            $device->lastupdate = $data['lastupdate'];
            $device->temperature = $data['temperature'];
            $device->save();

            return response('Success', 200);
        } else {
            return response()->json(['error' => 'Device not found'], 404);
        }
    }
}
