<?php

namespace App\Listeners;

use App\Events\NewPurchase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseMail;

class SendPurchaseMail implements ShouldQueue
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
     * @param  NewPurchase  $event
     * @return void
     */
    public function handle(NewPurchase $event)
    {
        Mail::to($event->email)->send(new PurchaseMail($event->userDetails, $event->products));
    }
}
