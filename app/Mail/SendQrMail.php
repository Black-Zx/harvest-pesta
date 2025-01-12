<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendQrMail extends Mailable

{
    use Queueable, SerializesModels;

     /**
     * The order instance.
     *
     * @var Order
     */
    public $customer;
    public $time_slot;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $time_slot)
    {
        $this->customer = $customer;
        $this->time_slot = $time_slot;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Rue 1664 2022')->view('emails.qr');
    }
}