<?php

namespace App;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;


class Size extends Model
{
    
    // relation to product
    public function products()
    {
        return $this->belongsToMany(Product::class ,'product_details');
    }
}
