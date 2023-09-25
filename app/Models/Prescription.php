<?php

namespace App\Models;

use App\Models\Traits\Attributes\PrescriptionAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\PrescriptionRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prescription extends BaseModel 
{
    use ModelAttributes, SoftDeletes, PrescriptionRelationships, PrescriptionAttributes;

    /**
     * The guarded field which are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The default values for attributes.
     *
     * @var array
     */
    protected $attributes = [];

    protected $with = ['prescription_iteams'];

    public static function generatePrescriptionNumber()
{
    $date = now()->format('Ymd');
    $lastPrescription = self::latest()->first();

    if ($lastPrescription) {
        $lastNumber = explode('-', $lastPrescription->prescription_number);
        $lastNumber = end($lastNumber);
        $nextNumber = str_pad($lastNumber + 1, 10, '0', STR_PAD_LEFT);
    } else {
        $nextNumber = '0000000001';
    }

    return "PRE-$date-$nextNumber";
}
}
