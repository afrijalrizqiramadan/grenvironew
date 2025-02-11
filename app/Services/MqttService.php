<?php

namespace App\Services;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\Exceptions\MqttClientException;

class MqttService
{
    protected $mqtt;

    public function __construct()
    {
        $host = '103.163.139.98';
        $port = 1883;
        $clientId = 'LaravelClient_' . rand();
        
        $this->mqtt = new MqttClient($host, $port, $clientId);
    }
    protected $messages = [];

    public function subscribe($topic = "#")
    {
        try {
            $this->mqtt->connect();
            $this->mqtt->subscribe($topic, function ($topic, $message) {
                $this->messages[] = "{$topic}: {$message}";
            }, 0);
    
            $this->mqtt->loop(true);
        } catch (MqttClientException $e) {
            echo "Error: " . $e->getMessage() . "\n\n";
        }
    }
    
    public function getMessages()
    {
        return $this->messages;
    }
}