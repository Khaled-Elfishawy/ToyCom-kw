<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class Product extends Model
{
    protected $casts = [
        'tax'         => 'float',
        'price'       => 'float',
        'capacity'    => 'float',
        'status'      => 'integer',
        'discount'    => 'float',
        'total_stock' => 'integer',
        'set_menu'    => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'price_group' => 'array',
    ];




    public function scopeActive($query)
    {
        return $query->where('status', '=', 1)->where('total_stock','>', 0);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->latest();
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class)->latest();
    }
    public function Ages()
    {
        return $this->hasMany(Product_age::class)->with('Age');
    }

    public function rating()
    {
        return $this->hasMany(Review::class)
            ->select(DB::raw('avg(rating) average, product_id'))
            ->groupBy('product_id');

    }
    public function getPriceAttribute(){
        if(Auth::guard('api')->check()){
            $user_group_id = auth('api')->user()->user_group;
            if (is_null($user_group_id)){
                return $this->attributes['price'];
            }else{
                if (array_key_exists($user_group_id, $this->price_group)) {
                    return $this->price_group[$user_group_id];
                }else{
                    return $this->attributes['price'];
                }
            }
        }else{
            return $this->attributes['price'];
        }
    }
//    public function getNameAttribute(){
//        if(app()->getLocale() == 'ar'){
//            return $this->attributes['name_ar'];
//        }else{
//            return $this->attributes['name'];
//        }
//    }

}
