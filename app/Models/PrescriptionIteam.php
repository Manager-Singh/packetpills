<?php

namespace App\Models;

use App\Models\Traits\Attributes\PrescriptionIteamAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\PrescriptionIteamRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrescriptionIteam extends BaseModel 
{
    use ModelAttributes, SoftDeletes, PrescriptionIteamRelationships, PrescriptionIteamAttributes;

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
