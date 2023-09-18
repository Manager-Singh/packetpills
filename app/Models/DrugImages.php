<?php

namespace App\Models;

// use App\Models\Traits\Attributes\DrugImagesAttributes;
// use App\Models\Traits\ModelAttributes;
// use App\Models\Traits\Relationships\DrugImagesRelationships;
// use Illuminate\Database\Eloquent\SoftDeletes;

class DrugImages extends BaseModel 
{
   // use ModelAttributes, SoftDeletes, DrugImagesRelationships, DrugImagesAttributes;

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
