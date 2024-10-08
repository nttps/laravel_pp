<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class RelateProduct extends Model
{
    protected $table = 'relate_products';
    protected $fillable = ['product_id', 'relate_id'];
}
