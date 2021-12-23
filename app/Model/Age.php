<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    protected $hidden=['order_num'];
    protected $fillable = [
        'name_ar' ,
        'name_en',
        'image',
        'order_num',

    ];
}
