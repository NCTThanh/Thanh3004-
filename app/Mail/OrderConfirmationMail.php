<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Thuộc tính để lưu mã đơn hàng.
     * @var string
     */
    public $order_code; 

    /**
     * Create a new message instance.
     *
     * @param string $orderCode
     * @return void
     */
    public function __construct($orderCode) 
    {
        $this->order_code = $orderCode; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Thuộc tính public $order_code sẽ tự động được truyền vào view.
        return $this->subject('Xác nhận yêu cầu đặt xe: ' . $this->order_code)
                    ->view('emails.order_confirmation');
    }
}