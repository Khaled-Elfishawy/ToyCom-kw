<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gift_warping extends Model
{
    protected $fillable = [
        'name_ar' ,
        'name_en',
        'price',
        'image',

    ];
}
