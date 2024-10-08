<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id' , 'proof_payment'];

    public function order()
    {
        return $this->hasOne('NttpDev\Model\Order' , 'order_id');
    }
}
