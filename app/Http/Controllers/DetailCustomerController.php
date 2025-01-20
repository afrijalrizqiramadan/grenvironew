<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\DeliveryStatus;
use App\Models\DataSensor;

class DetailCustomerController extends Controller
{

    public function detailPage($slug): View {
        $user = Auth::user();
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
            $latestPressure = DataSensor::where('device_id',  $id_device)
            ->orderBy('timestamp', 'desc')
            ->value('pressure');
            $sensorData = DataSensor::where('device_id', $id_device)->orderBy('timestamp')->get();

            // Mengumpulkan data nilai_sensor dan tanggal untuk chart
            $pressure = $sensorData->pluck('pressure');
            $timestamp = $sensorData->pluck('timestamp');

        return view('detail-customer', compact('maps','latestPressure','images','location','pressure', 'timestamp','nama', 'statuses','email','status_device','capacity','registration_date_device'));
          }

    }
}
