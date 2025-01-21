<?php

namespace App\Http\Controllers;

use App\Models\CentrePoint;
use App\Models\DataSensor;
use App\Models\Customer;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {

        $centrePoint = CentrePoint::get()->first();
        $customers = DataSensor::join('devices', 'data_sensors.device_id', '=', 'devices.id')
        ->join('customers', 'devices.id', '=', 'customers.device_id')
        ->join('indonesia_districts', 'customers.district', '=', 'indonesia_districts.id') // Join dengan tabel districts
        ->select('data_sensors.*', 'customers.*', 'indonesia_districts.name as district_name')
        ->get();
        return view('map',[
            'customers' => $customers,
            'centrePoint' => $centrePoint
        ]);
        //return dd($spaces);
    }

    public function show($slug)
    {

        $centrePoint = CentrePoint::get()->first();
        $spaces = Space::where('slug',$slug)->first();
        return view('detail-customer',[
            'centrePoint' => $centrePoint,
            'spaces' => $spaces
        ]);
    }
}
