<?php

namespace App\Models;

use App\Models\Traits\Attributes\PrescriptionOldAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\PrescriptionOldRelationships;

class PrescriptionOld extends BaseModel 
{
    use ModelAttributes, PrescriptionOldRelationships, PrescriptionOldAttributes;

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

    protected $with = [];
}
