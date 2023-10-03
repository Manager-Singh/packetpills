<?php

namespace App\Http\Responses\Backend\AutoMessages;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    protected $AutoMessage;

    public function __construct($AutoMessage)
    {
        $this->AutoMessage = $AutoMessage;
    }

    public function toResponse($request)
    {
        return view('backend.auto-messages.edit')->with([
            'autoMessage' => $this->AutoMessage,
        ]);
    }
}
