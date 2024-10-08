<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class TagArticle extends Model
{
    protected $fillable = ['name' , 'slug'];
    public function articles()
    {
        return $this->belongsToMany('NttpDev\Model\Article');
    }
}
