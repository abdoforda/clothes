<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    // relation with product
    public function products()
    {
        return $this->belongsToMany(Product::class)->orderBy('created_at', 'desc');
    }

    //products_random
    public function products_random()
    {
        return $this->belongsToMany(Product::class)->inRandomOrder()->limit(6)->get();
    }

    public function getImageAttribute($value)
    {
        if($this->show_like_home && $this->image_rectangular != null){
            return $this->image_rectangular;
        }
        return $value;
    }

}
