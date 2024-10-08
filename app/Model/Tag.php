<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = ['name' , 'slug'];
    public function products()
    {
        return $this->belongsToMany('NttpDev\Model\Product');
    }
}
