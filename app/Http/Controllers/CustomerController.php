<?php

namespace App\Http\Controllers;

use App\Models\BufferCustomer;
use App\Models\BufferCustomerHistories;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Spatie\Permission\Models\Role as ModelsRole;

class CustomerController extends Controller
{

    public function index()
    {
        // Menambahkan data diambil dari customers
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }
    public function create()
    {
        $provinces = \Indonesia::allProvinces();
        $centrepoint = env('APP_POINT');
        return view('customer.create', compact('provinces','centrepoint'));
    }

    public function customerPage(Request $request): View {

        $user = Auth::user();

        if($user->hasRole('administrator')) {
            $statuses = Trip::with('customer')->orderBy('delivery_date', 'desc')
            ->get();

            return view('customer/index', compact('statuses'));

        }
    }
    public function store(Request $request)
{
    DB::beginTransaction(); // Mulai transaksi

    try {
        // ✅ Debug: Periksa Data Masuk
        Log::info('Data Request Masuk', $request->all());
        
        // ✅ Validasi Data
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'telp' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email',
            'location' => 'nullable|string|max:255',
            'maps' => 'nullable|text',
            'latlong' => 'nullable|string', // Format: "latitude,longitude"
            'images' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'registration_date' => 'nullable|date',
            'type' => 'nullable|string|max:50',
            'capacity' => 'nullable|numeric',
            'buffer_id' => 'nullable|integer',
            'province' => 'nullable|string|max:255',
            'regency' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'village' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
        ]);

        // ✅ Buat customer baru
        $customer = new Customer();

        // ✅ Upload gambar jika ada
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $uploadFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/imgCover/'), $uploadFile);
            $customer->images = $uploadFile;
        }

        // ✅ Ambil latitude, longitude jika ada
        $latitude = null;
        $longitude = null;
        if ($request->filled('latlong') && str_contains($request->latlong, ',')) {
            [$latitude, $longitude] = explode(',', $request->latlong);
        }

        // ✅ Isi data customer
        $customer->fill($request->only([
            'name', 'address', 'telp', 'location', 'maps',
            'registration_date', 'type', 'capacity', 'buffer_id',
            'province', 'regency', 'district', 'village', 'status'
        ]));
        $customer->latitude = $latitude;
        $customer->longitude = $longitude;
        $customer->save();

        // ✅ Debug: Pastikan Customer Tersimpan
        // Log::info('Customer berhasil disimpan', ['customer_id' => $customer->id]);

        // ✅ Buat User otomatis setelah Customer berhasil dibuat
     
        $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make('defaultpassword'); // Gantilah dengan password yang diinginkan
    $user->save();

    // Assign role 'customer' ke user
    $user->assignRole('customer');
        
        $user->save();
        // ✅ Debug: Pastikan User Tersimpan
        Log::info('User berhasil dibuat', ['user_id' => $user->id]);

        DB::commit(); // Simpan transaksi

        return redirect()->route('customer.index')->with('success', 'Data berhasil disimpan.');
    } catch (\Exception $e) {
        DB::rollback(); // Batalkan transaksi jika terjadi error
        // Log::error('Terjadi kesalahan saat menyimpan data', ['error' => $e->getMessage()]);
        
        return redirect()->route('customer.create')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
public function show($id): View {
    $user = Auth::user();
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;
    if($user->hasRole('administrator')) {
        $customer = Customer::where('id',$id)->first();

    return view('customer.show', compact('customer'));
    
      }

}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $provinces = \Indonesia::allProvinces();
        $centrepoint = env('APP_POINT');
        $customer = Customer::findOrFail($customer->id);
        return view('customer.edit', [
            'customer' => $customer,
            'provinces' => $provinces,
            'centrepoint' => $centrepoint
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        try {

        // Menjalankan validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'telp' => 'nullable|string|max:20',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'location' => 'nullable|string|max:255',
            'maps' => 'nullable|text',
            'latlong' => 'nullable|string', // Format: "latitude,longitude"
            'images' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'registration_date' => 'nullable|date',
            'type' => 'nullable|string|max:50',
            'capacity' => 'nullable|numeric',
            'buffer_id' => 'nullable|integer',
            'province' => 'nullable|string|max:255',
            'regency' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'village' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
        ]);
        $customer = Customer::findOrFail($customer->id);

        // Update Customer Data
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->telp = $request->telp;
        $customer->email = $request->email;
        $customer->location = $request->location;
        $customer->maps = $request->maps;
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $uploadFile = time() . '_' . $file->getClientOriginalName();
            $destinationPath = 'uploads/imgCover/';
            
            // Delete existing file if exists
            if ($customer->images && file_exists($destinationPath . $customer->images)) {
                unlink($destinationPath . $customer->images);
            }
            
            $file->move($destinationPath, $uploadFile);
            $customer->images = $uploadFile;
        }
        $latlong = $request->input('latlong'); // Format: "latitude,longitude"
        [$latitude, $longitude] = explode(',', $latlong);
        $customer->latitude = $latitude;
        $customer->longitude = $longitude;

        // Lakukan Proses update data ke tabel space
        $customer->registration_date = $request->registration_date;
        $customer->type = $request->type;
        $customer->capacity = $request->capacity;
        $customer->buffer_id = $request->buffer_id;
        $customer->province = $request->provinsi;
        $customer->regency = $request->kota;
        $customer->district = $request->kecamatan;
        $customer->village = $request->desa;
        $customer->status = $request->status;
    
        $customer->save();
    
        // Update User terkait
        $user = User::findOrFail($customer->user_id);
        $user->name = $request->name;
        if ($request->email !== $user->email) {
            // Cek apakah email sudah dipakai user lain
            $existingUser = User::where('email', $request->email)->where('id', '!=', $user->id)->first();
            
            if ($existingUser) {
                return redirect()->back()->with('error', 'Email sudah digunakan oleh user lain.');
            }
        
            $user->email = $request->email;
        }
        // Jika ada perubahan password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
        return redirect()->route('customer.index')->with('success', 'Customer dan User berhasil diperbarui');
    } catch (\Exception $e) {
        DB::rollback(); // Batalkan transaksi jika terjadi error
        // Log::error('Terjadi kesalahan saat menyimpan data', ['error' => $e->getMessage()]);
        
        return redirect()->route('customer.edit', $customer->id)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // hapus keseluruhan data pada tabel space begitu juga dengan gambar yang disimpan
        $space = Customer::findOrFail($id);
        if (File::exists("uploads/imgCover/" . $space->image)) {
            File::delete("uploads/imgCover/" . $space->image);
        }
        $space->delete();
        return redirect()->route('space.index');
    }
}
