<?php

namespace App\Models;

use App\Color;
use App\Size;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $appends = ['final_price', 'is_discount','countdown'];

    // relastion cat
    public function cats()
    {
        return $this->belongsToMany(Cat::class);
    }

    // relastion color
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_details');
    }

    // relation size
    public function sizes()
    {
        return $this->belongsToMany(Size::class ,'product_details');
    }

    public function getFinalPriceAttribute()
    {
        
        if($this->discount_price == null || $this->date_start_discount == null){
            return $this->price;
        }

        $date_start = Carbon::parse($this->date_start_discount)->format('Y-m-d');
        $date_end = Carbon::parse($this->date_end_discount)->format('Y-m-d');
        $date = Carbon::now()->format('Y-m-d');
        
        // if date is between date_start and date_end
        if($date >= $date_start && $date <= $date_end){
            return $this->discount_price;
        }

        return $this->price;
    }

    //is_discount
    public function getIsDiscountAttribute()
    {
        if($this->discount_price == null || $this->date_start_discount == null){
            return false;
        }

        $date_start = Carbon::parse($this->date_start_discount)->format('Y-m-d');
        $date_end = Carbon::parse($this->date_end_discount)->format('Y-m-d');
        $date = Carbon::now()->format('Y-m-d');
        
        
        // if date is between date_start and date_end
        if($date >= $date_start && $date <= $date_end){
            return true;
        }
        
        return false;
    }

    //countdown
    public function getCountdownAttribute()
    {
        if($this->discount_price == null || $this->date_start_discount == null){
            return 0;
        }

        $date_start = Carbon::parse($this->date_start_discount)->format('Y-m-d');
        $date_end = Carbon::parse($this->date_end_discount)->format('Y-m-d');
        $date = Carbon::now();
        
        // if date is between date_start and date_end
        if($date >= $date_start && $date <= $date_end){
            return $date->diffInSeconds($date_end);
        }
        
        return 0;
    }

    //products_with_same_colors
    public function products_with_same_colors(){
        $colors = $this->colors()->get();
        // get products with same colors
        return Product::whereHas('colors', function($q) use ($colors){
            $q->whereIn('color_id', $colors->pluck('id'));
        })->where('id', '!=', $this->id)->take(6)->get()->shuffle();
    }

    // products_with_same_sizes
    public function products_with_same_sizes(){
        $sizes = $this->sizes()->get();
        // get products with same sizes
        return Product::whereHas('sizes', function($q) use ($sizes){
            $q->whereIn('size_id', $sizes->pluck('id'));
        })->where('id', '!=', $this->id)->take(6)->get()->shuffle();
    }

    // products_with_same_cats
    public function products_with_same_cats(){
        $cats = $this->cats()->get(); // جلب الأقسام

        $products = $cats->flatMap(function ($cat) {
            return $cat->products;
        })
        ->take(6)
        ->unique('id')
        ->shuffle(); // جلب المنتجات من جميع الأقسام وإزالة التكرار (إن وجد)

        return $products;
    }


    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // إذا كان الـ slug فارغًا، قم بإنشائه من العنوان
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
            
            // التحقق من التكرار
            $originalSlug = $model->slug;
            $counter = 1;

            while (static::where('slug', $model->slug)->exists()) {
                $model->slug = $originalSlug . '-' . $counter++;
            }
        });
    }


}
