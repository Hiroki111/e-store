<?php

namespace App\Traits;

trait HashedId
{
    public function getHashedIdAttribute()
    {
        return encode_hash($this->id);
    }
}
