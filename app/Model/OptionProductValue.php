<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class OptionProductValue extends Model
{
    protected $table = 'option_product_values';
    protected $fillable = ['option_product_id', 'value' , 'position' , 'parent_id'];
    public function option()
    {
        return $this->belongsTo('NttpDev\Model\OptionProduct', 'option_product_id');
    }
    public function variants()
    {
        return $this->belongsToMany('NttpDev\Model\OptionProductValue', 'products' , 'option_product_value_id', 'option_product_id' )->withPivot('id','sku' , 'inventory_quantity', 'shipping_price' , 'discount_price' , 'enable_stock');
    }

    public function parent()
    {
        return $this->belongsTo('NttpDev\Model\OptionProductValue', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('NttpDev\Model\OptionProductValue', 'parent_id');
    }

    
    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;

        while(!is_null($parent)) {
            $parent = '-'.$parent->parent;
        }

        return $parent;
    }
    
    public function PivotPrice()
    {//dd($this->distibutor_price);
        if(!auth()->guest()){
            if(auth()->user()->type == 'Dealer'){
                return ($this->pivot->dealer_price  != '' || $this->pivot->dealer_price != NULL || $this->pivot->dealer_price != 0) ? $this->pivot->dealer_price:  $this->pivot->price ;
            }
            if(auth()->user()->type == 'Distibutor'){
                return ($this->pivot->distibutor_price  != '' || $this->pivot->distibutor_price != NULL || $this->pivot->distibutor_price != 0) ? $this->pivot->distibutor_price: $this->pivot->price;
            }else{
                return $this->pivot->price;
            }
        }else{
            return $this->pivot->price;
        }

    }

    public function PivotDiscountPrice()
    {//dd($this->distibutor_price);
        if(!auth()->guest()){
            if(auth()->user()->type == 'Dealer'){
                return ($this->pivot->dealer_discount_price  != '' || $this->pivot->dealer_discount_price != NULL || $this->pivot->dealer_discount_price != 0) ? $this->pivot->dealer_discount_price:  $this->pivot->price ;
            }
            if(auth()->user()->type == 'Distibutor'){
                return ($this->pivot->distibutor_discount_price  != '' || $this->pivot->distibutor_discount_price != NULL || $this->pivot->distibutor_discount_price != 0) ? $this->pivot->distibutor_discount_price: $this->pivot->price;
            }else{
                return $this->pivot->price;
            }
        }else{
            return $this->pivot->price;
        }

    }
    /**
     * Get Price Sale To Cart
     * @return string
     */

    public function getPrice()
    {
        
        if($this->PivotDiscountPrice() != null || $this->PivotDiscountPrice() != ''){
            return (int)$this->PivotDiscountPrice();
        }
        return (int)$this->PivotPrice();
    }
}