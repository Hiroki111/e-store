<?php

namespace App;

use ArrayIterator;
use IteratorAggregate;

class SelectedFilter implements IteratorAggregate
{
    protected $conditions;
    protected $items;

    public function __construct($conditions)
    {
        $this->conditions = collect($conditions);
        $this->items      = [];
    }

    public function getIterator()
    {
        $items = $this->conditions->map(function ($value, $key) {
            if ($key === 'price_min') {
                $priceMin = explode(',', $this->conditions['price_min']);
                $priceMax = explode(',', $this->conditions['price_max']);
                $range    = collect($priceMin)->zip($priceMax)->map(function ($prices) {
                    return "$" . $prices[0] . " - $" . $prices[1];
                })->values()->all();
                return ['Price Range' => $range];
            } elseif (in_array($key, ['country_names', 'brand_names'])) {
                $keyName = explode('_', $key)[0];
                return [ucfirst($keyName) => explode(',', $value)];
            }

            return null;
        })->collapse()->all();

        return new ArrayIterator($items);
    }
}
