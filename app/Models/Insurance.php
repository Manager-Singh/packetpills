<?php

namespace App\Models;

use App\Models\Traits\Attributes\InsuranceAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\InsuranceRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insurance extends BaseModel
{
    use ModelAttributes, SoftDeletes, InsuranceAttributes, InsuranceRelationships;

    /**
     * Fillable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $table = 'insurance';

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
