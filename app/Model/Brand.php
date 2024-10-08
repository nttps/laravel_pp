<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name' , 'slug' , 'images' , 'seo_title' , 'seo_keyword' , 'seo_description'];

    public function products()
    {
        return $this->belongsTo('NttpDev\Model\Product');
    }
}
