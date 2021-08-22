<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    public function getImageAttribute($image)
    {
        if (!empty($image)){
            return  $image;
        }
        return 'default_brand_img.png';
    }
}
