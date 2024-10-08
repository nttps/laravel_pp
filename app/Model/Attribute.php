<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['name' , 'value'];
    public function products()
    {
        return $this->belongsToMany('NttpDev\Model\Product');
    }

    public function attribute()
    {
        return $this->belongsTo('NttpDev\Model\Attribute');
    }
}
