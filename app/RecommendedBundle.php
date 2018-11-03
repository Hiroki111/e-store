<?php

namespace App;

use App\Bundle;
use Illuminate\Database\Eloquent\Model;

class RecommendedBundle extends Model
{
    protected $guarded = [];
    protected $dates   = ['date'];

    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }

    public static function getBundles()
    {
        return self::all()->map(function ($recommendedBundle) {
            return $recommendedBundle->bundle;
        });
    }
}
