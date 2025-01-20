<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'devices';

    // Kolom yang bisa diisi

    use HasFactory;
    protected $fillable = ['device_id', 'uptime', 'memory', 'lastupdate', 'temperature'];

    // Nonaktifkan pengelolaan otomatis kolom created_at dan updated_at jika tidak diperlukan
    public $timestamps = false;


    public function customers()
    {
        return $this->belongsTo(Customer::class, 'device_id', 'device_id');
    }
}
