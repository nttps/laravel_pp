<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const AWAITPAYMENT = 1;
    const AWAITSHIPMENT = 2;
    const SHIPPED = 3;
    const CANCELLED = 4;

    protected $fillable = ['user_id' , 'billing_first_name' , 'billing_last_name' , 'billing_address_1' , 'billing_tumbon' , 'billing_city' , 'billing_state' , 'billing_postcode' , 'billing_country' , 'billing_email' , 'billing_phone' , 'order_create_by' ,'shipping_price' , 'order_price' , 'total' , 'status' , 'payment_method' , 'shipping_number'];

    public function products()
    {
        return $this->belongsToMany('NttpDev\Model\Product' , 'order_products' , 'order_id')->withPivot('quantity');
    }
    public function orderProduct()
    {
        return $this->hasMany('NttpDev\Model\OrderProduct');
    }
    public function payment()
    {
        return $this->hasOne('NttpDev\Model\Payment');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('NttpDev\User' , 'user_id');
    }
    public function getFullNameAttribute()
    {
        return $this->billing_first_name.' '.$this->billing_last_name;
    }
    public function getFullAddressAttribute()
    {
        return $this->getFullNameAttribute(). ' '.$this->billing_address_1.' '.$this->billing_tumbon. ' '.$this->billing_city.' '.$this->billing_state. ' '.$this->billing_country.' '.$this->billing_postcode;
    }

    public function getTotalPriceAttribute(){
        return number_format($this->total,2).' บาท';
    }
}
