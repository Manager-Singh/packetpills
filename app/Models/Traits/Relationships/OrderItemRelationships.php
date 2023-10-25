<?php

namespace App\Models\Traits\Relationships;
use App\Models\MedicationItem;

trait OrderItemRelationships
{
     
    public function medication()
    {
        return $this->belongsTo(MedicationItem::class);
    }
}
