<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Customer;
use App\Models\DeliveryPage;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DeliveryController extends Controller
{


    public function deliveryPage(Request $request): View {

        $user = Auth::user();
        if($user->hasRole('administrator')) {
            $customer = $user->customer; // Mendapatkan data customer yang terkait dengan pengguna
            $statusesProses = DeliveryStatus::with('customer')
            ->where('status', 'Disiapkan')
            ->get();
            $statusesKirim = DeliveryStatus::with('customer')
            ->where('status', 'Dalam Perjalanan')
            ->get();
            $statusesSelesai = DeliveryStatus::with('customer')
            ->where('status', 'Selesai')
            ->get();
            $statusesBatal = DeliveryStatus::with('customer')
            ->where('status', 'Batal')
            ->get();

            return view('admin/delivery', compact('user','statusesProses','statusesKirim','statusesSelesai','statusesBatal'));


        }elseif ($user->hasRole('customer')) {
            $customer = $user->customer; // Mendapatkan data customer yang terkait dengan pengguna
            $customer_id = $customer->id;
            $statusesProses = DeliveryStatus::with('customer')
            ->where('status', 'Disiapkan')
            ->where('customer_id', $customer_id)
            ->get();
            $statusesKirim = DeliveryStatus::with('customer')
            ->where('status', 'Dalam Perjalanan')
            ->where('customer_id', $customer_id)
            ->get();
            $statusesSelesai = DeliveryStatus::with('customer')
            ->where('customer_id', $customer_id)
            ->where('status', 'Selesai')
            ->get();
            $statusesBatal = DeliveryStatus::with('customer')
            ->where('customer_id', $customer_id)
            ->where('status', 'Batal')
            ->get();
            return view('admin/delivery', compact('user','statusesProses','statusesKirim','statusesSelesai','statusesBatal'));
        }
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|string|max:255',
            'delivery_date' => 'required|date',
            'customer_name' => 'required|string',
            'total' => 'required|numeric',
            'status' => 'required|string|max:255',
        ]);

        try {
            DeliveryStatus::create([
                'customer_id' => $request->customer_id,
                'delivery_date' => $request->delivery_date,
                'total' => $request->total,
                'status' => $request->status,
            ]);
            return response()->json(['success' => true, 'message' => 'Data inserted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e]);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $deliveryStatus = DeliveryStatus::find($id);
        if ($deliveryStatus) {
            $deliveryStatus->status = $request->input('status');
            $deliveryStatus->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Status not found'], 404);
    }
}
