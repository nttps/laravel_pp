<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'product_variants';
    protected $fillable = ['product_id', 'option_product_id' , 'option_product_value_id'];
}
