<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class AttributeProduct extends Model
{
    protected $table = 'attribute_products';
    protected $fillable = ['product_id', 'attribute_id' , 'attribute_value' , 'position' , 'is_show' , 'is_option'];

   
}
