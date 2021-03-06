<?php

namespace App\Models;

use App\Models\LocationMeta;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = [];
    protected $table = 'locations';
    public $timestamps = false;

    public function locationMeta()
    {
        return $this->hasOne(LocationMeta::class);
    }
}
