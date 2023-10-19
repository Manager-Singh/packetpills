<?php

namespace App\Models\Traits\Relationships;

use App\Models\Auth\User;

trait PrescriptionRelationships
{
    
    /**
     * Prescription belongsTo with User.
     */
    public function prescription_iteams(){

        //return $this->hasMany(PrescriptionIteam::class, 'prescripiton_id');
        return $this->hasMany('App\Models\PrescriptionIteam', 'prescripiton_id');
    }
    public function medications(){
        return $this->hasMany('App\Models\MedicationItem', 'prescription_id');
    }
    
}
