<?php

namespace NttpsApp\Models;
    
use Illuminate\Database\Eloquent\Relations\Pivot;
class ProductHasAttribute extends Pivot {
    
    public function product()
    {
        return $this->belongsTo('NttpsApp\Models\Product');
    }
    
    public function attribute_values()
    {
        return $this->belongsTo('NttpsApp\Models\AttributeValue');
    }
    
    public function attribute()
    {
        return $this->hasManyThrough('NttpsApp\Models\Attribte', 'NttpsApp\Models\AttributeValue');
    }
   
}