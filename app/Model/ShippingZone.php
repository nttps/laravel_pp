<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class ShippingZone extends Model
{
    protected $fillable = [
        'name' , 'title' ,'type' ,  'options'
    ];

    public function rules()
    {
        return $this->hasMany('NttpDev\Model\ShippingRule');
    }

    public function values()
    {
        return $this->belongsToMany('NttpDev\Model\Province' , 'shipping_zone_values');
    }
}
