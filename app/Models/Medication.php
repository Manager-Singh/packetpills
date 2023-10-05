<?php

namespace App\Models;

use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\MedicationRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medication extends BaseModel 
{
    use ModelAttributes, SoftDeletes, MedicationRelationships;

    /**
     * The guarded field which are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The default values for attributes.
     *
     * @var array
     */
    protected $attributes = [];
}
