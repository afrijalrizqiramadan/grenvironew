<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Trip;
use App\Models\BufferCustomer;
use App\Models\Device;

class PressureController extends Controller
{
    public function pressurePage(Request $request): View {
        $user = $request->user();

        if($user->hasRole('administrator')) {
            $latestPressures = BufferCustomer::select('customers.id','customers.name','customers.capacity','customers.telp', 'buffer_customers.name', 'buffer_customers.pressure','buffer_customers.temperature')
            ->leftJoin('customers', 'buffer_customers.customer_id', '=', 'customers.id')
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
            $statuses = Trip::where('customer_id', $customer_id)->orderBy('delivery_date', 'desc')
            ->take(5)->get();
            $latestPressure = BufferCustomer::where('buffer_id',  $id_device)
            ->orderBy('timestamp', 'desc')
            ->value('pressure');
            $sensorData = BufferCustomer::where('buffer_id', $id_device)->orderBy('timestamp')->get();

            // Mengumpulkan data nilai_sensor dan tanggal untuk chart
            $pressure = $sensorData->pluck('pressure');
            $timestamp = $sensorData->pluck('timestamp');

            $latestPressures = BufferCustomer::select('customers.name','customers.capacity', 'buffer_customers.buffer_id','buffer_customers.buffer_id', 'buffer_customers.pressure', 'buffer_customers.temperature')
            ->leftJoin('customers', 'buffer_customers.buffer_id', '=', 'customers.buffer_id')
            ->whereColumn('buffer_customers.id', function ($subQuery) {
                $subQuery->selectRaw('MAX(id)')
                    ->from('buffer_customers as ds')
                    ->whereColumn('ds.buffer_id', 'buffer_customers.buffer_id');
            })
            ->get();
            
        return view('admin/historypressure', compact('latestPressures'));
        }
        elseif($user->hasRole('technician')) {
            return view('admin/historypressure');
         }
    }
}
