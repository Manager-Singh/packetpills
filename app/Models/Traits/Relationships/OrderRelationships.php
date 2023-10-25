<?php

namespace App\Models\Traits\Relationships;
use App\Models\OrderItem;
use App\Models\Prescription;

trait OrderRelationships
{
     
    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'prescription_id');
    }
}
