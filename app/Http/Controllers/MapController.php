<?php

namespace App\Http\Controllers;

use App\Models\CentrePoint;
use App\Models\Customer;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {

        $centrePoint = CentrePoint::get()->first();
        $spaces = Customer::get();
        return view('map',[
            'spaces' => $spaces,
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
