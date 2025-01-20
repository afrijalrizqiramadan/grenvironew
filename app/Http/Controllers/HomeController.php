<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use App\Models\DeliveryStatus;
use App\Models\HistorySensor;
use App\Models\Device;
use App\Models\DataSensor;
use Carbon\Carbon;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }


    public function root()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $user = Auth::user();

        if($user->hasRole('administrator')) {
            $user = Auth::user(); // Mendapatkan pengguna yang sedang login
            $customerCount = Customer::count(); // Menghitung jumlah data customer
            $averagePressure = DataSensor::avg('pressure');
            $lowPressureCount = DataSensor::where('pressure', '<', 20)->count();

            $minpressuresensor = DataSensor::join('devices', 'data_sensors.device_id', '=', 'devices.id')
            ->join('customers', 'devices.id', '=', 'customers.device_id')
            ->join('indonesia_districts', 'customers.district', '=', 'indonesia_districts.id') // Join dengan tabel districts
            ->select('data_sensors.*', 'customers.*', 'indonesia_districts.name as district_name')
            ->get();

            $countDeliveries = DeliveryStatus::where('status', 'Selesai')
            ->whereYear('delivery_date', now()->year)
            ->whereMonth('delivery_date', now()->month)
            ->count();

              return view('dashboard-administrator', compact('countDeliveries','customerCount','lowPressureCount','averagePressure', 'minpressuresensor'));
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
            $maps = $device->maps;
            $email = $customer->email;
            $id_device = $device->id;
            $status_device = $device->status;
            $sensorData = HistorySensor::where('device_id', $id_device)
            ->whereMonth('timestamp', $currentMonth)
            ->whereYear('timestamp', $currentYear)
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

            $registration_date_device = $customer->registration_date;
            $statuses = DeliveryStatus::where('customer_id', $customer_id)->orderBy('delivery_date', 'desc')
            ->take(5)->get();
           $latestPressure = DataSensor::where('device_id',  $id_device)
            ->orderBy('timestamp', 'desc')
            ->value('pressure');
            $latestTime = DataSensor::where('device_id',  $id_device)
            ->orderBy('timestamp', 'desc')
            ->value('timestamp');
            $sensorData = HistorySensor::where('device_id', $id_device)
            ->whereMonth('timestamp', $currentMonth)
            ->whereYear('timestamp', $currentYear)
            ->orderBy('timestamp')
            ->get();

            // Mengumpulkan data nilai_sensor dan tanggal untuk chart
            $pressure = $sensorData->pluck('pressure');
            $timestamp = $sensorData->pluck('timestamp');

        return view('dashboard-customer', compact('customer','pressure_history','latestTime','weatherData','maps','id_device','latestPressure','images','location','pressure', 'timestamp','nama', 'statuses','email','status_device','capacity','registration_date_device'));
        }
        elseif($user->hasRole('technician')) {

            $deviceData = Device::get();
            $user = Auth::user(); // Mendapatkan pengguna yang sedang login
            $customerCount = Customer::count(); // Menghitung jumlah data customer
            $averagePressure = DataSensor::avg('pressure');
            $lowPressureCount = DataSensor::where('pressure', '<', 20)->count();

            $minpressuresensor = DataSensor::join('devices', 'data_sensors.device_id', '=', 'devices.id')
            ->join('customers', 'devices.id', '=', 'customers.device_id')
            ->join('indonesia_districts', 'customers.district', '=', 'indonesia_districts.id') // Join dengan tabel districts
            ->select('data_sensors.*', 'customers.*', 'indonesia_districts.name as district_name')
            ->get();

            $countDeliveries = DeliveryStatus::where('status', 'Selesai')
            ->whereYear('delivery_date', now()->year)
            ->whereMonth('delivery_date', now()->month)
            ->count();

              return view('dashboard-technician', compact('deviceData','countDeliveries','lowPressureCount','customerCount','averagePressure', 'minpressuresensor'));
         }
    }

   

    public function getPressureData($id_device)
    {
        $data = DataSensor::where('device_id', $id_device)->latest()->first(['pressure', 'timestamp']);
        return response()->json($data);
    }

    public function getTemperatureData($id_device)
    {
        $data = DataSensor::where('device_id', $id_device)->latest()->first(['temperature', 'timestamp']);
        return response()->json($data);
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar =  $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "User Details Updated successfully!"
            // ], 200); // Status code here
            return redirect()->back();
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "Something went wrong!"
            // ], 200); // Status code here
            return redirect()->back();

        }
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Your Current password does not matches with the password you provided. Please try again."
            ], 200); // Status code
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Password updated successfully!"
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!"
                ], 200); // Status code here
            }
        }
    }
}
