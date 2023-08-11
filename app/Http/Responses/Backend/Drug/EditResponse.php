<?php

namespace App\Http\Responses\Backend\Drug;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    protected $drug;

    protected $status;

    public function __construct($drug, $status)
    {
        $this->drug = $drug;
        $this->status = $status;
    }

    public function toResponse($request)
    {
        
        return view('backend.drugs.edit')->with([
            'drug' => $this->drug,
            'status' => $this->status,
        ]);
    }
}
