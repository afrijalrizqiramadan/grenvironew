<?php

namespace App\Http\Controllers;

use App\Services\MqttService;
use Illuminate\Http\Request;

class MqttController extends Controller
{
    public function showMqttLog()
    {
        return view('mqtt-log');
    }

    public function subscribeMqtt()
    {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

        $mqtt = new MqttService();
        $mqtt->subscribe("#");
    }
    public function mqttLog()
{
    $mqtt = new MqttService();
    $messages = $mqtt->getMessages();  // This would get the latest messages

    return response()->json([
        'messages' => $messages
    ]);
}
}