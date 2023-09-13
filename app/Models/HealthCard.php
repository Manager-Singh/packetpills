<?php

namespace App\Models;


use App\Models\Auth\Traits\Attributes\HealthCardAttributes;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User.
 */
class HealthCard extends BaseModel
{
    use   SoftDeletes, HealthCardAttributes;
    protected $guarded = [];
    protected $table = 'health_card';
}
