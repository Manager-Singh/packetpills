<?php

namespace App\Http\Responses\Backend\Provinces;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    protected $province;

    public function __construct($province)
    {
        $this->province = $province;
    }

    public function toResponse($request)
    {
        return view('backend.provinces.edit')->with([
            'province' => $this->province,
        ]);
    }
}
