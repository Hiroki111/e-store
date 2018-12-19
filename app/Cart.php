<?php

namespace App;

use App\Bundle;
use App\Product;
use ArrayIterator;
use IteratorAggregate;

class Cart implements IteratorAggregate
{
    private $count;
    private $items;

    public function __construct($items)
    {
        $this->items = $items;
        $this->count = collect($this->items)->map(function ($items) {
            return array_reduce($items, function ($total, $item) {return $total + $item;});
        })->reduce(function ($total, $qty) {
            return $total + $qty;
        });
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function getItems()
    {
        return collect($this->items)->map(function ($items, $type) {
            return collect($items)->map(function ($qty, $hashedId) use ($type) {
                $class = ($type === 'product') ? Product::class : Bundle::class;
                $item  = $class::find(decode_hash($hashedId));
                return (object) [
                    'src'         => $item->src,
                    'name'        => $item->name,
                    'price'       => $item->price,
                    'qty'         => $qty,
                    'total_price' => number_format((double) $item->price * $qty, 2),
                ];
            })->values()->all();
        })->collapse()->all();
    }

    public function getIterator()
    {
        return new ArrayIterator($this->getItems());
    }

    public function getTotalPrice()
    {
        $total = array_reduce($this->getItems(), function ($total, $item) {
            return $total + (double) $item->total_price;
        });
        return number_format($total, 2);
    }
}
