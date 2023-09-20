<?php

namespace App\Models\Traits\Relationships;

use App\Models\DrugImages;
use App\Models\DrugAttribute;

trait DrugRelationships
{
   
   

    /**
     * Drugs belongsTo with User.
     */
    public function images()
    {
        return $this->hasMany(DrugImages::class);
    }

    public function default_image() {
        return $this->images()->where('type', 'default');
    }

    public function strenthUnit()
    {
        return $this->belongsTo(DrugAttribute::class, 'strength_unit_id');
    }

    public function packSize()
    {
        return $this->belongsTo(DrugAttribute::class, 'pack_unit_id');
    }
    public function format()
    {
        return $this->belongsTo(DrugAttribute::class, 'format_id');
    }

    

    
}
