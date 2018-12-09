<?php

namespace App\Traits;

trait Price
{
    public function getDollarsAttribute()
    {
        return (int) $this->price;
    }

    public function getCentsAttribute()
    {
        return bcsub($this->price, $this->dollars, 2) * 100;
    }
}
