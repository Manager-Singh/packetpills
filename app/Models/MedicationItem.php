<?php

namespace App\Models;

use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\MedicationItemRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicationItem extends BaseModel
{
    use ModelAttributes, SoftDeletes, MedicationItemRelationships;

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

    /**
     * Statuses.
     *
     * @var array
     */
    protected $statuses = [
        0 => 'InActive',
        1 => 'Active',
    ];

    /**
     * Appends.
     *
     * @var array
     */
    protected $appends = [
        'display_status',
    ];
}
