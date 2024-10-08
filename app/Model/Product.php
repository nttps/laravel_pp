<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Product extends Model
{
    protected $fillable = ['name' , 'slug' , 'sku' , 'distibutor_price' ,'distibutor_discount_price','dealer_price','dealer_discount_price', 'inventory_quantity' , 'old_inventory_quantity' ,'body_html' , 'short_description' , 'discount_price' , 'price' , 'shipping_price' , 'image' , 'meta_title' , 'meta_description' , 'meta_keyword' , 'enable_stock' , 'relate_product' ,'brand_id' , 'is_option', 'is_sales' , 'product_parent' , 'product_type' , 'option_product_id' , 'option_product_value_id' , 'parent_option_product_value_id' , 'is_show' , 'is_banner'];




    public function categories()
    {
        return $this->belongsToMany('NttpDev\Model\Category' , 'category_products');
    }

    public function tags()
    {
        return $this->belongsToMany('NttpDev\Model\Tag' , 'tag_products');
    }
    public function relateProduct()
    {
        return $this->belongsToMany('NttpDev\Model\Product' , 'relate_products', 'product_id','relate_id');
    }

    public function brands()
    {
        return $this->belongsTo('NttpDev\Model\Brand' ,'brand_id' ,'id');
    }

    public function attributes()
    {
        return $this->belongsToMany('NttpDev\Model\Attribute' , 'attribute_products')->withPivot('id','attribute_value' , 'position' , 'is_show' , 'is_option');
    }

    public function options()
    {
        return $this->hasMany('NttpDev\Model\OptionProduct');
    }
    public function parent()
    {
        return $this->belongsTo('NttpDev\Model\Product', 'product_parent');
    }
    public function children()
    {
        return $this->hasMany('NttpDev\Model\Product', 'product_parent');
    }
    public function variants()
    {
        return $this->belongsToMany('NttpDev\Model\OptionProductValue', 'products' , 'product_parent', 'option_product_value_id' )->withPivot( 'id','sku' , 'inventory_quantity' , 'shipping_price',  'discount_price' , 'price', 'enable_stock' , 'distibutor_price' ,'distibutor_discount_price','dealer_price','dealer_discount_price');
    }
    public function optionsValue()
    {
        return $this->hasMany('NttpDev\Model\OptionProductValue');
    }
    public function getName(){
        if(session()->has('applocale')){
            if(session()->get('applocale') == 'en'){

                if($this->name_en ==''){
                    return $this->name;
                }
                return $this->name_en;
            }
            return $this->name;
        }
        return $this->name;
    }
    public function getShortDescription(){
        if(session()->has('applocale')){
            if(session()->get('applocale') == 'en'){
                if($this->short_description_en ==''){
                    return $this->short_description;
                }
                return $this->short_description_en;
            }
            return $this->short_description;
        }
        return $this->short_description;
    }
    public function getHTML(){
        if(session()->has('applocale')){
            if(session()->get('applocale') == 'en'){
                if($this->body_html_en ==''){
                    return $this->body_html;
                }
                return $this->body_html_en;
            }
            return $this->body_html;
        }
        return $this->body_html;
    }
    public function getPriceAttribute($value)
    {
    
        if(!auth()->guest()){
            if(auth()->user()->type == 'Dealer'){
                return ($this->dealer_price  != '' || $this->dealer_price != NULL || $this->dealer_price != 0) ? $this->dealer_price:  $value ;
            }
            if(auth()->user()->type == 'Distibutor'){
                return ($this->distibutor_price  != '' || $this->distibutor_price != NULL || $this->distibutor_price != 0) ? $this->distibutor_price: $value;
            }else{
                return $value;
            }
        }else{
            return $value;
        }

    }
    public function getDiscountPriceAttribute($value)
    {

        if(!auth()->guest()){
            if(auth()->user()->type == 'Dealer'){
                return ($this->dealer_discount_price != '' || $this->dealer_discount_price != NULL || $this->dealer_discount_price != 0) ? $this->dealer_discount_price : $value;
            }
            if(auth()->user()->type == 'Distibutor'){
                return ($this->distibutor_discount_price != '' || $this->distibutor_discount_price != NULL || $this->distibutor_discount_price != 0) ? $this->distibutor_discount_price : $value;
            }else{
                return $value;
            }
        }else{
            return $value;
        }

    }

   /**
     * Get Price Discount
     *
     * @return string
     */
    public function getRealPriceAttribute()
    {

        if($this->is_option == 1){
            return $this->range_price;
        }else{
            if($this->discount_price != null || $this->discount_price != ''){
                return '<div class="regular_price" style="color:black;">'.$this->price . ' '.__('main.word.currency').'</div><div class="sale_price text-danger">'.$this->discount_price . ' '.__('main.word.currency').'</div>';
    
            }
            return '<div class="sale_price float-right" style="line-height:18px;color:black;">'.$this->price . ' '.__('main.word.currency').'</div><div style="clear:both;"></div>';
        }
        
        
        
        
    }

       /**
     * Get Price Discount
     *
     * @return string
     */
    public function getRealPriceBannerAttribute()
    {

        if($this->is_option == 1){
            return $this->range_price_banner;
        }else{
            if($this->discount_price != null || $this->discount_price != ''){
                return '<div class="regular_price" style="color:black;">'.$this->price . ' '.__('main.word.currency').'</div><div class="sale_price text-danger">'.$this->discount_price . ' '.__('main.word.currency').'</div>';
    
            }
            return '<div class="sale_price float-right" style="line-height:18px;color:black;">'.$this->price . ' '.__('main.word.currency').'</div><div style="clear:both;"></div>';
        }
        
        
        
        
    }


    public function getRangePriceAttribute(){
        $min = $this->children()->get()->min('price');
        $max = $this->children()->get()->max('price');
        if(!auth()->guest()){
            if(auth()->user()->type == 'Dealer'){
                if($this->dealer_price  != '' || $this->dealer_price != NULL || $this->dealer_price != 0){
                    $min = $this->children()->get()->min('dealer_price');
                    $max = $this->children()->get()->max('dealer_price');
                }
            }
            if(auth()->user()->type == 'Distibutor'){
                if($this->distibutor_price  != '' || $this->distibutor_price != NULL || $this->distibutor_price != 0){
                    $min = $this->children()->get()->min('distibutor_price');
                    $max = $this->children()->get()->max('distibutor_price');
                }                   
            }else{
                $min = $this->children()->get()->min('price');
                $max = $this->children()->get()->max('price');
            }
        }else{
            $min = $this->children()->get()->min('price');
            $max = $this->children()->get()->max('price');
        }
        
        if($min == $max){
            return  '<span class="" style="line-height:18px;color:black;">'.__('main.word.price_starts_at'). ' '.$min. ' '.__('main.word.currency').'</span>';
        }
        return  '<span class="" style="line-height:18px;color:black;">'.__('main.word.price_starts_at'). ' ' .$min.' - '.$max . ' '.__('main.word.currency').'</span>';
        
        
    
        
    }

    public function getRangePriceBannerAttribute(){
        $min = $this->children()->get()->min('price');
        $max = $this->children()->get()->max('price');
        if(!auth()->guest()){
            if(auth()->user()->type == 'Dealer'){
                if($this->dealer_price  != '' || $this->dealer_price != NULL || $this->dealer_price != 0){
                    $min = $this->children()->get()->min('dealer_price');
                    $max = $this->children()->get()->max('dealer_price');
                }
            }
            if(auth()->user()->type == 'Distibutor'){
                if($this->distibutor_price  != '' || $this->distibutor_price != NULL || $this->distibutor_price != 0){
                    $min = $this->children()->get()->min('distibutor_price');
                    $max = $this->children()->get()->max('distibutor_price');
                }                   
            }else{
                $min = $this->children()->get()->min('price');
                $max = $this->children()->get()->max('price');
            }
        }else{
            $min = $this->children()->get()->min('price');
            $max = $this->children()->get()->max('price');
        }
        
        if($min == $max){
            return  '<span class="" style="line-height:18px;color:black;">'.__('main.word.price_starts_at'). ' '.$min. ' '.__('main.word.currency').'</span>';
        }
        return  '<span class="" style="line-height:18px;color:black;">'.__('main.word.price_starts_at'). ' ' .$min.' '.__('main.word.currency').'</span>';
        
        
    
        
    }


    public function getVarientAttribute(){
        return $this->children()->get();
    }
    
   /**
     * Get Percent Discount
     *
     * @return string
     */
    public function getPercentDiscount()
    {
        if($this->is_option != '1'){
            if($this->discount_price != null || $this->discount_price != '' ){
                $saving_percentage = round( 100 - ( $this->discount_price /$this->price * 100 ), 1 ) . '%';
                return '<div class="percent-discount">ถูกกว่า <br> '.$saving_percentage.'</div>';
            } 
        }
        return '';
        
    }
    /**
     * Get Price Sale To Cart
     * @return string
     */

    public function getPrice()
    {
        
        if($this->discount_price != null || $this->discount_price != ''){
            return (int)$this->discount_price;
        }
        return (int)$this->price;
        
    }



}
