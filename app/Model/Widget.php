<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $fillable = ['image', 'url_link' ,'widget_type' , 'enable'];
}
