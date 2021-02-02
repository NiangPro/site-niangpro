<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * getFormattedPrice
     *
     * @return void
     */
    public function getFormattedPrice()
    {
        $price = $this->price / 100;

        return number_format($price, 2, ",", " ") . " £";
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
