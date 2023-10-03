<?php

namespace App\Models;

use App\Models\Traits\Attributes\AutoMessageAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\AutoMessageRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class AutoMessage extends BaseModel
{
    use ModelAttributes, SoftDeletes, AutoMessageAttributes, AutoMessageRelationships;

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
