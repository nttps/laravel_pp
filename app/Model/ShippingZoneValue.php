<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class ShippingZoneValue extends Model
{
    protected $table = 'shipping_zone_values';
    protected $fillable = ['shipping_zone_id', 'province_id'];
}
