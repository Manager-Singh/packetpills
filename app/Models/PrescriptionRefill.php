<?php
namespace App\Models;
use App\Models\Prescription;
use App\Models\Auth\User;

class PrescriptionRefill extends BaseModel
{
   
    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'prescription_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
