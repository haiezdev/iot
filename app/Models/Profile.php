<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'description', 'command_list_id', 'device_group_id'];

    public function commandList() {
        return $this->belongsTo(CommandList::class);
    }

    public function deviceGroup() {
        return $this->belongsTo(DeviceGroup::class);
    }
}
