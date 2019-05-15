<?php

namespace App;

use App\Bundle;
use App\OrderItem;
use App\Product;
use ArrayIterator;
use IteratorAggregate;

class Cart implements IteratorAggregate
{
    private $count;
    private $items;

    public function __get($name)
    {
        return $this->$name;
    }

    public function isEmpty()
    {
        if (empty($this->items)) {
            return true;
        }

        return $this->count < 1;
    }

    public function setItems($items)
    {
        $this->items = $items;
        $this->count = collect($this->items)->map(function ($items) {
            return array_reduce($items, function ($total, $item) {return $total + $item;});
        })->reduce(function ($total, $qty) {
            return $total + $qty;
        });
        return $this;
    }

    public function getItems()
    {
        return collect($this->items)->map(function ($items, $type) {
            return collect($items)->map(function ($qty, $hashedId) use ($type) {
                $class = ($type === 'product') ? Product::class : Bundle::class;
                $item  = $class::find(decode_hash($hashedId));
                return (object) [
                    'id'          => $hashedId,
                    'src'         => $item->src,
                    'name'        => $item->name,
                    'price'       => $item->price,
                    'url'         => $item->url,
                    'type'        => $type,
                    'qty'         => $qty,
                    'total_price' => number_format((double) $item->price * $qty, 2),
                ];
            })->values()->all();
        })->collapse()->all();
    }

    public function toOrderItems()
    {
        return collect($this->items)->map(function ($items, $type) {
            return collect($items)->map(function ($qty, $hashedId) use ($type) {
                $class = ($type === 'product') ? Product::class : Bundle::class;
                $item  = $class::find(decode_hash($hashedId));

                return collect(range(0, $qty - 1))->map(function ($i) use ($item, $type) {
                    return new OrderItem([
                        'stock_id' => $item->id,
                        'name'     => $item->name,
                        'type'     => $type,
                        'price'    => $item->price,
                    ]);
                })->values()->all();
            });
        })->map(function ($items) {
            return $items->collapse()->all();
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

    public function getTotalPriceInCents()
    {
        $total = array_reduce($this->getItems(), function ($total, $item) {
            return $total + (double) $item->total_price;
        });
        return $total * 100;
    }
}
