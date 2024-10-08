<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $table = 'category_products';
    protected $fillable = ['product_id', 'category_id'];
}
