<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Customer;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CentrePoint;

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
        $centrepoint = CentrePoint::get()->first();
        return view('customer.create', compact('provinces','centrepoint'));
    }

    public function customerPage(Request $request): View {

        $user = Auth::user();

        if($user->hasRole('administrator')) {
            $statuses = DeliveryStatus::with('customer')->orderBy('delivery_date', 'desc')
            ->get();

            return view('customer/index', compact('statuses'));

        }
    }
    public function store(Request $request)
    {

        // Lakukan validasi data
        
        $request->validate([
            'name' => 'required|string|max:25',
            'address' => 'required|string',
            'telp' => 'required',
            'location' => 'required|string|max:20',
            'maps' => 'nullable|string',
            'images' => 'image|mimes:png,jpg,jpeg',
            'registration_date' => 'required|date',
            'type' => 'required|string|max:20',
            'capacity' => 'required|numeric',
            'device_id' => 'required|integer',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $customer = new Customer();
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $uploadFile = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/imgCover/', $uploadFile);
            $customer->images = $uploadFile;
        }

        $latlong = $request->input('latlong'); // Format: "latitude,longitude"
        [$latitude, $longitude] = explode(',', $latlong);

        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->telp = $request->telp;
        $customer->location = $request->location;
        $customer->maps = $request->maps;
        $customer->latitude = $latitude;
        $customer->longitude = $longitude;
        $customer->registration_date = $request->registration_date;
        $customer->type = $request->type;
        $customer->capacity = $request->capacity;
        $customer->device_id = $request->device_id;
        $customer->province = $request->provinsi;
        $customer->regency = $request->kota;
        $customer->district = $request->kecamatan;
        $customer->village = $request->desa;
        $customer->status = $request->status;

        $customer->save();
        if ($customer) {
            return redirect()->route('customer.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('customer.index')->with('error', 'Data gagal disimpan');
        }
    }
    public function show($id)
    {
        //
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
        $centrepoint = CentrePoint::get()->first();
        $customer = Customer::findOrFail($customer->id);
        return view('customer.edit', [
            'customer' => $customer,
            'provinces' => $provinces,
            'centrepoint' => $centrepoint
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        // Menjalankan validasi
        $validated = $request->validate([
            'name' => 'required|string|max:25',
            'address' => 'required|string',
            'telp' => 'required',
            'location' => 'required|string|max:20',
            'maps' => 'nullable|string',
            'images' => 'image|mimes:png,jpg,jpeg',
            'registration_date' => 'required|date',
            'type' => 'required|string|max:20',
            'capacity' => 'required|numeric',
            'device_id' => 'required|integer',
            'status' => 'required|in:Aktif,Tidak Aktif',
            ]);

        $customer = Customer::findOrFail($customer->id);
        if ($request->hasFile('image')) {
            if (File::exists("uploads/imgCover/" . $customer->image)) {
                File::delete("uploads/imgCover/" . $customer->image);
            }

            $file = $request->file("image");
            //$uploadFile = StoreImage::replace($space->image,$file->getRealPath(),$file->getClientOriginalName());
            $uploadFile = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/imgCover/', $uploadFile);
            $customer->image = $uploadFile;
        }
        $latlong = $request->input('latlong'); // Format: "latitude,longitude"
        [$latitude, $longitude] = explode(',', $latlong);

        // Lakukan Proses update data ke tabel space
        $customer->update([
            'name' => $request->name,
            'address' => $request->address,
            'telp' => $request->telp,
            'location' => $request->location,
            'maps' => $request->maps,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'registration_date' => $request->registration_date,
            'type' => $request->type,
            'capacity' => $request->capacity,
            'device_id' => $request->device_id,
            'province' => $request->provinsi,
            'regency' => $request->kota,
            'district' => $request->kecamatan,
            'village' => $request->desa,
            'status' => $request->status
        ]);

        // redirect ke halaman index space
        if ($customer) {
            return redirect()->route('customer.index')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->route('customer.index')->with('error', 'Data gagal diupdate');
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
