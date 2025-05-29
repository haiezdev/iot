<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'ip_address', 'status', 'description', 'device_group_id'
    ];
    
    // App\Models\Device.php
public function deviceGroup() {
    return $this->belongsTo(\App\Models\DeviceGroup::class, 'device_group_id');
}

}
