<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryStatus extends Model
{
    use HasFactory;
     // Jika nama tabel tidak sesuai dengan penamaan default
     protected $table = 'delivery_status';

     // Tentukan kolom yang bisa diisi
     protected $fillable = ['customer_id','total', 'delivery_date','status']; // sesuaikan dengan kolom yang ada
     public function customer()
     {
        return $this->belongsTo(Customer::class, 'customer_id');
     }


}
