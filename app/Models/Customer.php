<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class Customer extends Model
{
    protected $table = 'customers';
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'buffer_id',
        'name',
        // tambahkan kolom lain yang diperlukan
    ];

    public function dataSensors()
    {
        return $this->hasMany(DataSensor::class, 'buffer_id', 'devices_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
  
    public function getImage()
    {
        if (substr($this->image, 0, 5) == "https") {
            return $this->image;
        }

        if ($this->image) {
            return asset('/images/customer/' . $this->image);
        }

        return 'https://via.placeholder.com/500x500.png?text=No+Cover';
    }
    
}
