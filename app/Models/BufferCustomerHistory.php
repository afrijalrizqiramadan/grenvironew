<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BufferCustomerHistories extends Model
{
    use HasFactory;
    protected $fillable = [
        'buffer_id',
        'timestamp',
        'pressure',
        'temperature',
    ];
}
