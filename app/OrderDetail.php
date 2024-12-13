<?php

namespace App;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;


class OrderDetail extends Model
{
    // relationship to product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }   
}
