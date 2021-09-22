<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    public function Cities() {
        return $this->hasMany('App\Model\City', 'zone_id')->with('Districts')->select('id','name','zone_id');
    }
}
