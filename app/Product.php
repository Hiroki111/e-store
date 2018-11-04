<?php

namespace App;

use App\Traits\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use Price;

    protected $guarded = [];
    protected $dates   = ['date'];
}
