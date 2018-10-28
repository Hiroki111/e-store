<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $dates   = ['date'];

    public function getDollarsAttribute()
    {
        return (int) $this->price;
    }

    public function getSentsAttribute()
    {
        return ($this->price - $this->dollars) * 100;
    }
}
