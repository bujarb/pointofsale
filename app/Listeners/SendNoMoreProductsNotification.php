<?php

namespace App\Listeners;

use App\Events\ProductOutOfRange;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNoMoreProductsNotification
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
     * @param  ProductOutOfRange  $event
     * @return void
     */
    public function handle(ProductOutOfRange $event)
    {
        //
    }
}
