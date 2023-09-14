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

    protected $drugs_formats = [
        'lotion' => 'Lotion',
        'tablets' => 'Tablets',
        'syrup' => 'Syrup',
        'cream' => 'Cream',
        'spray' => 'Spray',
        'shampoo' => 'Shampoo',
    ];
    protected $strength_units = [
        '%' => 'Percent',
        'mg' => 'Miligram',
        'mg/ml' => 'Miligram Per Milliliter',  
    ];
    protected $pack_units = [
        'ml' => 'Milliliter',
        'g' => 'Grams',
        'capsules' => 'Capsules',
        'tablet' => 'Tablet',
        'wafers' => 'Wafers',
        'suppositiores' => 'Suppositiores',
    ];
    protected $insurance_coverage_in_percent = [
        '0' => '0',
        '50' => '50',
        '80' => '80',
        '90' => '90',
        '100' => '100',
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
