<?php

namespace App\Libraries;

use Mail;

class SendMail {

    protected $data         = array();
    protected $content      = "";
    protected $receiver     = "";
    protected $email_to     = "";
    protected $subject      = "";
    protected $email_from   = "";
    protected $attachment   = array();
    protected $first_name   = "";
    protected $last_name    = "";


    public function clientRegister($content,$data, $subject) {
        $this->data     = $data;
        $this->receiver = $data['name'];
        $this->email_to = $data['email'];
        $this->subject  = $subject;
        $this->content  = $content;
        $this->_sendMail();
    }

    private function _sendMail ( ) {
        Mail::send($this->content, $this->data, function ($message) {
            $message->from(env('MAIL_FROM_ADDRESS'), strtoupper(env('MAIL_FROM_NAME')))
                    ->to($this->email_to, $this->receiver)
                    ->replyTo('no-reply@charplingenterprise.com')
                    ->subject($this->subject);
        });
    }

    // private function _sendMailToAdmin(){
    //     Mail::send($this->content, $this->data, function ($message) {
    //         // $message->from(config('constants.site.email'), strtoupper(siteConfig()->name))
    //         $message->from(env('MAIL_FROM_ADDRESS'), strtoupper(siteConfig()->name))
    //                 ->to(siteConfig()->gmail)
    //                 ->replyTo($this->email_to, $this->receiver)
    //                 ->subject($this->subject);
    //     });
    // }
}
