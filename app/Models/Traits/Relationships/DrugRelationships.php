<?php

namespace App\Models\Traits\Relationships;

use App\Models\DrugImages;

trait DrugRelationships
{
   
   

    /**
     * Drugs belongsTo with User.
     */
    public function images()
    {
        return $this->hasMany(DrugImages::class);
    }

}
