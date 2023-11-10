<?php

namespace App\Models\Traits\Relationships;

use App\Models\Auth\User;

trait TransferRequestsRelationships
{
    // public function prescription_type(){

    //     //return $this->hasMany(PrescriptionIteam::class, 'prescripiton_id');
    //     return $this->hasOne('App\Models\PrescriptionIteam', 'prescripiton_id');
    // }

    public function owner()
    {
        return $this->hasOne(User::class, 'id');
    }
    
}
