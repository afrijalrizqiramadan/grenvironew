<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripDestination extends Model
{
    use HasFactory;

    public function buffercustomer()
    {
        return $this->belongsTo(BufferCustomer::class, 'buffer_customers', 'id');
    }
}
