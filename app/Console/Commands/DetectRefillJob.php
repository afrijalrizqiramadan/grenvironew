<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
class DetectRefillJob extends Command {
    protected $signature = 'detect:refill';
    protected $description = 'Cek pengisian ulang gas di semua device';


    public function handle() {
        $devices = DB::table('devices')->pluck('id'); // 🔥 Ambil dari tabel device

foreach ($devices as $device_id) {
    $customer = DB::table('customers')->where('device_id', $device_id)->first();
    if (!$customer) continue;

    // ✅ Ambil data terbaru dari history_sensors
    $latest = DB::table('history_sensors')
        ->where('device_id', $device_id)
        ->orderBy('created_at', 'desc')
        ->first();

    if (!$latest) continue; // Jika tidak ada data, skip

    // 🔥 Cek apakah ada data dalam 1 jam terakhir
    $pressure_before = DB::table('history_sensors')
        ->where('device_id', $device_id)
        ->whereBetween('created_at', [Carbon::now()->subMinutes(60), Carbon::now()->subMinutes(10)])
        ->min('pressure');

    // 🛑 Jika tidak ada data dalam 1 jam, gunakan tekanan terakhir dari tabel device_last_pressure
    if (!$pressure_before) {
        $pressure_before = DB::table('data_sensors')
            ->where('device_id', $device_id)
            ->value('pressure');

        if (!$pressure_before) continue;
    }

    // ✅ Lanjut proses deteksi pengisian
    $pressure_after = $latest->pressure;
    $increase = $pressure_after - $pressure_before;
    $threshold = 15;

    if ($increase > $threshold) {
        $recentPressures = DB::table('history_sensors')
            ->where('device_id', $device_id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->pluck('pressure')
            ->toArray();

        if ($this->isRefillOngoing($recentPressures)) {
            $this->info("⏳ Pengisian gas device $device_id masih berlangsung...");
            continue;
        }

        // Cek apakah sudah dicatat sebelumnya
        $existing = DB::table('delivery_status')
            ->where('delivery_date', '>=', now()->subMinutes(60))
            ->exists();

        if (!$existing) {
            DB::table('delivery_status')->insert([
                'device_id' => $device_id,
                'customer_id' => $customer->id,
                'pressure_before' => $pressure_before,
                'pressure_after' => $pressure_after,
                'total' => $increase,
                'status' => "Selesai",
                'created_at' => now(),
                'delivery_date' => now()
            ]);

            $this->info("✅ Pengisian ulang terdeteksi untuk device $device_id");
        }
    }

    // 🔥 Simpan tekanan terbaru agar bisa digunakan jika perangkat mati
    // DB::table('device_last_pressure')->updateOrInsert(
    //     ['device_id' => $device_id],
    //     ['pressure' => $latest->pressure, 'updated_at' => now()]
    // );
}

$this->info('✅ Detect refill executed successfully');
    }

    // Cek apakah tekanan masih naik (pengisian belum selesai)
    private function isRefillOngoing($pressures) {
        if (count($pressures) < 3) return false;
        return $pressures[0] > $pressures[1] && $pressures[1] > $pressures[2]; // Masih naik
    }

    // Cek apakah tekanan masih naik (pengisian belum selesai)
    // private function isRefillOngoing($pressures) {
    //     if (count($pressures) < 3) return false;
    //     // Log::info($pressures[0]);
    //     // Log::info($pressures[1]);
    //     // Log::info($pressures[2]);
    //     // Log::info($pressures[0] > $pressures[1] && $pressures[1] > $pressures[2]);
    //     return $pressures[0] > $pressures[1] && $pressures[1] > $pressures[2]; // Masih naik
    // }
}