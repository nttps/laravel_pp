<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class TagOfProduct extends Model
{
    protected $fillable = ['product_id', 'tag_id'];
}
