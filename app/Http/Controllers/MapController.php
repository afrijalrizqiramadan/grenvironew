<?php

namespace App\Http\Controllers;

use App\Models\BufferCustomer;
use App\Models\Customer;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {

        $centrePoint = env('APP_POINT');
        $customers = BufferCustomer::join('customers', 'buffer_customers.customer_id', '=', 'customers.id')
        ->join('indonesia_districts', 'customers.district', '=', 'indonesia_districts.id') // Join dengan tabel districts
        ->select('buffer_customers.*', 'customers.*', 'indonesia_districts.name as district_name')
        ->get();
        return view('map',[
            'customers' => $customers,
            'centrePoint' => $centrePoint
        ]);
        //return dd($spaces);
    }

    public function show($slug)
    {

        $centrePoint = env('APP_POINT');
        $spaces = Space::where('slug',$slug)->first();
        return view('detail-customer',[
            'centrePoint' => $centrePoint,
            'spaces' => $spaces
        ]);
    }
}
