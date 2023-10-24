<?php

namespace App\Models;

//use App\Models\Traits\Attributes\OrderItemAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\OrderItemRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends BaseModel
{

    //OrderItemAttributes
    use ModelAttributes, SoftDeletes, OrderItemRelationships;

    /**
     * Fillable.
     *
     * @var array
     */
    protected $guarded = [];

  
}
