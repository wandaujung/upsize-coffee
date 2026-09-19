<?php

namespace App\Listeners;

use App\Events\OrderCreated;

class UpdateStockAfterOrder
{
    public function handle(OrderCreated $event)
    {
        $order = $event->order;


        foreach ($order->items as $item) {

            $product = $item->product;


            $product->decrement(
                'stock',
                $item->quantity
            );

        }
    }
}