<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PressureController;
use App\Http\Controllers\TemperatureController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\OutletMapController;
use App\Http\Controllers\CentrePointController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SpaceController;
use App\Http\Livewire\MembersTable;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SensorDataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::post('/send-data', [SensorDataController::class, 'store']);
// Route::get('/get-buzzer', [AktuatorController::class, 'getBuzzer']);
// Route::post('/update-device', [DeviceController::class, 'update']);
// Route::get('/sensor-data', [SensorDataController::class, 'getFilteredSensorData']);
Route::post('/insert-delivery', [DeliveryController::class, 'store'])->name('insert.route');
Route::post('/update-status/{id}', [DeliveryController::class, 'updateStatus']);
Route::get('/sensor-pressure/{id_device}', [DashboardController::class, 'getPressureData']);
Route::get('/sensor-temperature/{id_device}', [DashboardController::class, 'getTemperatureData']);
Route::get('/sensor-data', [SensorDataController::class, 'getSensorData']);

