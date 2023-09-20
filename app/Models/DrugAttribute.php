<?php

namespace App\Models;

// use App\Models\Traits\Attributes\DrugAttributeAttributes;
use App\Models\Traits\ModelAttributes;
// use App\Models\Traits\Relationships\DrugAttributeRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class DrugAttribute extends BaseModel
{
    use ModelAttributes, SoftDeletes;

    /**
     * Fillable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

  

 
}
