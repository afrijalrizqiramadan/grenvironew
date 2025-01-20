<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'drivers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'address',
        'license_number',
        'license_expiry',
        'vehicle_id',
        'availability_status',
        'assigned_area',
        'experience_years',
        'photo',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'license_expiry' => 'date',
    ];

    /**
     * The attributes that should be mutated to dates for soft delete.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the vehicle associated with the driver.
     */
    /**
     * Scope a query to only include available drivers.
     */
    public function scopeAvailable($query)
    {
        return $query->where('availability_status', 'Available');
    }
}