<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\OtpSent;
use Illuminate\Contracts\Mail\Mailer;
use Mail;

class SendOtpEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $body;
    protected $email;
    protected $template;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($body,$email,$template)
    {
        
        $this->body=$body;
        $this->email=$email;
        $this->template=$template;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Mail::to($this->email)->send(new OtpSent($this->body,$this->template));
        $body=$this->body;
        $emailuser=$this->email;
        $subject=$this->template->subject;
        Mail::send('emails.verify', ['content'=>$body], function ($message) use($subject,$emailuser) {

            $message->to($emailuser)
                ->subject($subject);

        });
    }
}
