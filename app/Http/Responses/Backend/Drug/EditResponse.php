<?php

namespace App\Http\Responses\Backend\Drug;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    protected $drug;

    protected $status;
    protected $formats;
    protected $strength_unit;
    protected $pack_unit;
    protected $insurance_coverage_in_percent;
    protected $preciption_types_id;

    public function __construct($drug, $status,$formats,$strength_unit,$pack_unit,$insurance_coverage_in_percent,$preciption_types_id)
    {
        $this->drug = $drug;
        $this->status = $status;
        $this->formats = $formats;
        $this->strength_unit = $strength_unit;
        $this->pack_unit = $pack_unit;
        $this->insurance_coverage_in_percent = $insurance_coverage_in_percent;
        $this->status = $status;
        $this->preciption_types_id = $preciption_types_id;
    }

    public function toResponse($request)
    {
        
        return view('backend.drugs.edit')->with([
            'drug' => $this->drug,
            'status' => $this->status,
            'formats'=>$this->formats,
            'strength_unit'=>$this->strength_unit,
            'pack_unit'=>$this->pack_unit,
            'insurance_coverage_in_percent'=>$this->insurance_coverage_in_percent,
            'preciption_types_id'=>$this->preciption_types_id,
        ]);
    }
}
