<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryArticle extends Model
{
    protected $fillable = ['parent_id' , 'name' , 'slug' , 'meta_title' , 'meta_keyword' , 'meta_description'];

    public function parent()
    {
        return $this->belongsTo('NttpDev\Model\CategoryArticle', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('NttpDev\Model\CategoryArticle', 'parent_id');
    }
}
