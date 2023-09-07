<?php

namespace App\Models;

//use App\Models\Traits\Attributes\ConnectAttributes;
//use App\Models\Traits\ModelAttributes;
//use App\Models\Traits\Relationships\ConnectRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnterpriseConnect extends BaseModel 
{
   // use ModelAttributes, SoftDeletes, ConnectRelationships, ConnectAttributes;
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
    ];



}
