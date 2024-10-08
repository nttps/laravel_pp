<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class OptionProduct extends Model
{

    protected $table = 'option_products';
    protected $fillable = ['product_id', 'option_name' , 'position' , 'parent_id'];
    public function values()
    {
        return $this->hasMany('NttpDev\Model\OptionProductValue', 'option_product_id');
    }

    public function variants()
    {
        return $this->belongsToMany('NttpDev\Model\OptionProductValue', 'products' , 'option_product_id', 'option_product_value_id' )->withPivot('id','sku' , 'inventory_quantity' , 'discount_price' , 'option_product_value_id' , 'enable_stock');
    }
    public function parent()
    {
        return $this->belongsTo('NttpDev\Model\OptionProduct', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('NttpDev\Model\OptionProduct', 'parent_id');
    }

}
