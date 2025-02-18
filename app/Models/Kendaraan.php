<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;
    public function dataSensors()
    {
        return $this->hasMany(Tracking::class, 'buffer_id', 'devices_id');
    }

   
    public function device()
    {
        return $this->belongsTo(Device::class, 'buffer_id');
    }
}
