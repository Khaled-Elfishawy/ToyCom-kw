<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{


//    public function getImageAttribute($image)
//    {
//        if (!empty($image)){
//            return  $image;
//        }
//        return 'default_brand_img.png';
//    }
protected $hidden=['order_num'];
    protected $fillable = [
        'name_ar' ,
        'name_en',
        'order_num',
        'image'
    ];

}
