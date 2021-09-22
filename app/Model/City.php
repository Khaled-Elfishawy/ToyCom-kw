<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function Districts() {
        return $this->hasMany('App\Model\district', 'city_id')->select('id','name','city_id');;
    }
}
