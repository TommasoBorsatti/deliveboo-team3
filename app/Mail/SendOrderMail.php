<?php

namespace App\Mail;

use App\Order;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, User $user)
    {
        
        $this->order = $order;
        $this->user = $user;

        return compact('order', 'user');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.orderMail');
    }
}
