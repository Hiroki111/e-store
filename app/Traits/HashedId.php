<?php

namespace App\Traits;

use Vinkla\Hashids\Facades\Hashids;

trait HashedId
{
    public function getHashedIdAttribute()
    {
        return Hashids::encode($this->id);
    }

    public static function getByHashedId($hashedId)
    {
        if (empty(Hashids::decode($hashedId))) {
            return null;
        }
        return self::find(Hashids::decode($hashedId)[0]);
    }
}
