<?php

namespace App\Models\Traits\Relationships;
use App\Models\OrderItem;

trait OrderRelationships
{
     
    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
