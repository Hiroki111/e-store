<?php

namespace App\Traits;

use Vinkla\Hashids\Facades\Hashids;

trait HashedId
{
    public function getHashedIdAttribute()
    {
        return Hashids::encode($this->id);
    }
}
