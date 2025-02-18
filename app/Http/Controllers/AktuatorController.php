<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataAktuator;
use Illuminate\Support\Facades\Log;

class AktuatorController extends Controller
{
    public function getBuzzer(Request $request)
    {
        $id = $request->input('buffer_id');
        $api_key = $request->input('api_key');

        if ($api_key === env('API_KEY')) {
            $buzzer = DB::table('data_aktuators')
            ->where('id', $id)
            ->pluck('buzzer')
            ->first();
            Log::info('Buzzer: ' . $buzzer);
                return response($buzzer, 200)
                    ->header('Content-Type', 'text/plain');
        } else {
            return response('0', 403)
                ->header('Content-Type', 'text/plain');
        }
     }
}
