<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAktuator extends Model
{
    use HasFactory;
    protected $table = 'data_aktuators'; // Nama tabel dalam database
    protected $fillable = [
        'device_id',
        'buzzer',
        'heater',
    ];

   public function device()
    {
        return $this->belongsTo(Device::class, 'device_id', 'id');
    }
    public function device_id()
    {
        return $this->belongsTo(Device::class);
    }
}
