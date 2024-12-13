<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Page extends Model
{
    

    // get slug
    public function href()
    {
        $value = $this->slug;
        return route('page', ['slug' => $value]);
    }

}
