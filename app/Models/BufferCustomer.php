<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BufferCustomer extends Model
{
    use HasFactory;

    protected $table = 'buffer_customers'; // Nama tabel dalam database
    protected $fillable = [
        'buffer_id',
        'timestamp',
        'pressure',
        'temperature',
    ];

   public function device()
    {
        return $this->belongsTo(Device::class, 'buffer_id', 'id');
    }
    public function buffer_id()
    {
        return $this->belongsTo(Device::class);
    }
    public function buffercustomer()
    {
        return $this->belongsTo(Customer::class, 'id');
    }
}
