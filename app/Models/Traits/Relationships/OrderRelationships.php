<?php

namespace App\Models\Traits\Relationships;
use App\Models\OrderItem;
use App\Models\Prescription;
use App\Models\Auth\User;

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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
