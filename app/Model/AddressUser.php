<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class AddressUser extends Model
{
    protected $table = 'address_users';
    protected $fillable = ['user_id', 'address_id'];
}
