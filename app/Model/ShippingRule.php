<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class ShippingRule extends Model
{
    protected $fillable = [
        'shipping_zone_id' , 'name' ,'method' , 'rules'
    ];

    public function zone()
    {
        return $this->belongTo('NttpDev\Model\ShippingZone');
    }
}
