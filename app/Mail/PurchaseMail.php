<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $userDetails;
    protected $products;

    public function __construct(array $userDetails, object $products)
    {
        $this->userDetails = $userDetails;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.purchase')
                    ->with([
                        'userDetails' => $this->userDetails,
                        'products' => $this->products,
                    ]);
    }
}
