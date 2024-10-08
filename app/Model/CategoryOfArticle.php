<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryOfArticle extends Model
{
    protected $table = 'category_of_articles';
    protected $fillable = ['article_id', 'category_article_id'];
}
