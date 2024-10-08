<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['name' , 'slug' , 'image' , 'meta_title' , 'meta_description' , 'meta_keyword'];

    public function categories()
    {
        return $this->belongsToMany('NttpDev\Model\CategoryArticle' , 'category_of_articles');
    }

    public function tags()
    {
        return $this->belongsToMany('NttpDev\Model\TagArticle' , 'tag_of_articles' );
    }

}
