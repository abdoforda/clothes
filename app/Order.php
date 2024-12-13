<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    // relationship to OrderDetail
    public function items()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
