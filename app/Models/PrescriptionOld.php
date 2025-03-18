<?php

namespace App\Models;

use App\Models\Traits\Attributes\PrescriptionOldAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Prescription;
use App\Models\Auth\User;
use App\Models\MedicationItem;
use App\Models\Traits\Relationships\PrescriptionOldRelationships;

class PrescriptionOld extends BaseModel 
{
    use ModelAttributes, PrescriptionOldRelationships, PrescriptionOldAttributes;

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

    protected $with = [];
    // public function prescription()
    // {
    //     return $this->belongsTo(Prescription::class, 'prescription_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function medication()
    // {
    //     return $this->belongsTo(MedicationItem::class, 'medication_id');
    // }
    
}
