<?php

namespace App\Models\Traits\Relationships;

use App\Models\Auth\User;

trait PrescriptionOldRelationships
{
    
    /**
     * PrescriptionIteam belongsTo with User.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
}
