<?php

namespace App\Http\Responses\Backend\MailMessages;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    protected $MailMessage;

    public function __construct($MailMessage)
    {
        $this->MailMessage = $MailMessage;
    }

    public function toResponse($request)
    {
        return view('backend.mail-messages.edit')->with([
            'MailMessage' => $this->MailMessage,
        ]);
    }
}
