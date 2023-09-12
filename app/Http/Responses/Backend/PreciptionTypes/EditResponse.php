<?php

namespace App\Http\Responses\Backend\PreciptionTypes;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    protected $preciptionType;

    public function __construct($preciptionType)
    {
        $this->preciptionType = $preciptionType;
    }

    public function toResponse($request)
    {
        return view('backend.preciption-types.edit')->with([
            'preciptionType' => $this->preciptionType,
        ]);
    }
}
