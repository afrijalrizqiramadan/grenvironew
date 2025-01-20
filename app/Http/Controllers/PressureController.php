<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\DeliveryStatus;
use App\Models\DataSensor;

class PressureController extends Controller
{
    public function pressurePage(Request $request): View {
        $user = $request->user();

        if($user->hasRole('administrator')) {
            $latestPressures = DataSensor::select('customers.id','customers.name','customers.telp','customers.location', 'data_sensors.device_id', 'data_sensors.pressure')
            ->leftJoin('customers', 'data_sensors.device_id', '=', 'customers.device_id')
            ->whereIn('data_sensors.id', function ($query) {
                $query->selectRaw('MAX(id)')
                      ->from('data_sensors')
                      ->groupBy('device_id');
            })
            ->get();

        return view('admin/historypressure', compact('latestPressures'));
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
            $email = $customer->email;
            $id_device = $device->id;
            $status_device = $device->status;
            $registration_date_device = $customer->registration_date;
            $statuses = DeliveryStatus::where('customer_id', $customer_id)->orderBy('delivery_date', 'desc')
            ->take(5)->get();
            $latestPressure = DataSensor::where('device_id',  $id_device)
            ->orderBy('timestamp', 'desc')
            ->value('pressure');
            $sensorData = DataSensor::where('device_id', $id_device)->orderBy('timestamp')->get();

            // Mengumpulkan data nilai_sensor dan tanggal untuk chart
            $pressure = $sensorData->pluck('pressure');
            $timestamp = $sensorData->pluck('timestamp');

            $latestPressures = DataSensor::select('customers.name', 'data_sensors.device_id', 'data_sensors.pressure', 'data_sensors.temperature')
            ->leftJoin('customers', 'data_sensors.device_id', '=', 'customers.device_id')
            ->whereColumn('data_sensors.id', function ($subQuery) {
                $subQuery->selectRaw('MAX(id)')
                    ->from('data_sensors as ds')
                    ->whereColumn('ds.device_id', 'data_sensors.device_id');
            })
            ->get();
            
        return view('admin/historypressure', compact('latestPressures'));
        }
        elseif($user->hasRole('technician')) {
            return view('admin/historypressure');
         }
    }
}
