<?php

namespace App\Models;

use App\Models\Traits\Attributes\DrugAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\DrugRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drug extends BaseModel
{
    use ModelAttributes, SoftDeletes, DrugAttributes, DrugRelationships;

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
        'drug_cost',
        'patient_pays',
        'drug_strength',
        'drug_pack',
    ];
}
