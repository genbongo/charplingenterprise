<?php
    namespace App\Helpers\Mail;
    use App\Mail\MailSetup;
    use Illuminate\Support\Facades\Mail;
    use Exception;

    class SenderHelper { 

        /** Handles the details of mail */
        private $details;

        /** Handles the template of mail */
        private $template;
        
        /** Handles the receiver of mail */
        private $receiver;


        public function __construct($template, $receiver, $details){
            $this->template = $template;
            $this->details = $details;
            $this->receiver = $receiver;
            $this->set();
        }

        public function set() {
            try {
                Mail::to($this->receiver)->send(new MailSetup($this->details, $this->template, $this->receiver));
                return [
                    'receiver'  => $this->receiver,
                    'details'   => $this->details,
                    'template'  => $this->template,
                ];
            } catch(Exception $e) {
                return $e->getMessage();
            }
        }
    }
