<?php

namespace App\Models;

use App\Models\DeviceMeta;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $guarded = [];
    protected $table = 'devices';
    public $timestamps = false;

    public function deviceMeta()
    {
        return $this->hasOne(DeviceMeta::class);
    }
}
