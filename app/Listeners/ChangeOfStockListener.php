<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Product;

class ChangeOfStockListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $products = $event->sale->products()->select('products.id')->get();
        Product::where(function($query) use($products){
          foreach ($products as $product) {
            $query->orWhere('id','=',$product->id);
          }
        })->update(['stock'=>0]);
    }
}
