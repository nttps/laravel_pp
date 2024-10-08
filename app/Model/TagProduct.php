<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class TagProduct extends Model
{
    protected $table = 'tag_products';
    protected $fillable = ['product_id', 'tag_id'];
}
