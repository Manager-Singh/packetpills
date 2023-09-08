<?php

namespace App\Models;

use App\Models\Traits\Attributes\EnterpriseConnectAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\EnterpriseConnectRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnterpriseConnect extends BaseModel 
{
    use ModelAttributes, SoftDeletes, EnterpriseConnectRelationships, EnterpriseConnectAttributes;

    protected $fillable = [
        'full_name',
        'company',
        'job_title',
        'email',
        'phone_no',
        'status'
    ];

    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $appends = [
        'status_label',
        'phone_number'
    ];
}

