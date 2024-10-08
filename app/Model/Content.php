<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['title', 'slug' , 'body_html' , 'meta_title' , 'meta_description' , 'meta_keyword' , 'type' , 'is_show' , 'image'];
}
