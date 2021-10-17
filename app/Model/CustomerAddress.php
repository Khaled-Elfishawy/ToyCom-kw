<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $casts = [
        'user_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    protected $guarded = [];

    public function Zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }
    public function City()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function District()
    {
        return $this->belongsTo(district::class, 'district_id');
    }
}
