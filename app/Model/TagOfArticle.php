<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class TagOfArticle extends Model
{
    
    protected $table = 'tag_of_articles';
    protected $fillable = ['article_id', 'tag_article_id'];
}
