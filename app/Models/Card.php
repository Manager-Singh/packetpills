<?php

namespace App\Models;


use App\Models\Traits\ModelAttributes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends BaseModel
{
    use ModelAttributes, SoftDeletes;

    /**
     * Fillable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $table = 'card';

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