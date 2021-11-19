<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class XacNhanTaiKhoanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->subject = "Thế Giới Nước Hoa Của Tôi";
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->replyTo('trancongminhtri@gmail.com', 'Minh Trí')
        ->view('email.xac-nhan-tai-khoan', [
            'data' => $this->data
        ]);
    }
}
