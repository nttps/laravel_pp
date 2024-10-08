<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class VariantProduct extends Model
{

    protected $table = 'variant_products';
    protected $fillable = ['option_product_id', 'option_product_value_id' ,'sku' , 'inventory_quantity' , 'discount_price' , 'price' , 'status'];
}
