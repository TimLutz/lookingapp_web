<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OtpSent extends Mailable
{
    use Queueable, SerializesModels;

    public $body;
    
    private $template;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body,$template)
    {
        $this->body=$body;
        $this->template=$template;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $body=$this->body;
        $subject=$this->template->subject;
        return $this->view('emails.verify')->subject($subject)->with(['content'=>$body]);
    }
}
