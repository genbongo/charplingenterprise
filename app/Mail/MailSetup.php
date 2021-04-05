<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Support\Facades\Auth;
class MailSetup extends Mailable
{
    use Queueable, SerializesModels;


    public $details;

    private $mail_template;

    public $receiver;


    /**
     * Create a new message instance.
     * @param $details - Array , $mail_template - String 
     */
    public function __construct($details, $mail_template = "default", $receiver)
    {
        $this->details          = $details;
        $this->mail_template    = $mail_template;
        $this->receiver         = $receiver;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        switch ($this->mail_template) {

            case 'registration':
                $page = "emails.register";
            break;
            case 'reminder':
                $page = "emails.reminder";
            break;
            case 'client_deactivation':
                $page = "emails.client_deactivation";
            break;
            case 'client_approval':
                $page = "emails.client_approval";
            break;
            case 'store_approval':
                $page = "emails.store_approval";
            break;
            default:
                $page = "emails.register";
            break;
        }

        return $this->view($page)
            ->subject($this->details['subject']);
    }
}
