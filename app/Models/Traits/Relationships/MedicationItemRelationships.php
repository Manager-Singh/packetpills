<?php

namespace App\Models\Traits\Relationships;

use App\Models\Auth\User;
use App\Models\Drug;
use App\Models\Prescription;

trait MedicationItemRelationships
{
   

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }
    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'prescription_id');
    }
    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders(){
        return $this->hasMany('App\Models\Order', 'user_id', 'user_id')
        ->whereColumn('prescription_id', 'prescription_id');
    }

    public function order_item(){
        return $this->hasMany('App\Models\OrderItem', 'medication_id');
    }
    
}
