<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $fillable = ['first_name' , 'last_name' , 'address_1' , 'tumbon' , 'city' , 'state' , 'postcode' , 'country' , 'email' , 'phone' , 'is_default'];

    public function users()
    {
        return $this->belongsToMany('NttpDev\User' , 'address_users');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getFullAddressAttribute()
    {
        return 'ชื่อผู้รับ '.$this->getFullNameAttribute(). ' '.$this->address_1.' แขวง'.$this->tumbon. ' เขต'.$this->city.' จังหวัด'.$this->state. ' '.$this->country.' '.$this->postcode. ' '.$this->email.' '.$this->phone;
    }
}
