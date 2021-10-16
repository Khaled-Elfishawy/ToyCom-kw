<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product_age extends Model
{
    protected  $guarded = [];

    public function Age()
    {
        return $this->belongsTo(Age::class,'age_id');
    }
}
