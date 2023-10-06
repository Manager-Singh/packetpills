<?php

namespace App\Models\Traits\Attributes;

trait DrugAttributes
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group" role="group" aria-label="'.trans('labels.backend.access.users.user_actions').'">'.
                $this->getEditButtonAttribute('edit-drug', 'admin.drugs.edit').
                $this->getDeleteButtonAttribute('delete-drug', 'admin.drugs.destroy').
                '</div>';
    }

    /**
     * Get Display Status Attribute.
     *
     * @var string
     */
    public function getDisplayStatusAttribute(): string
    {
        if ($this->isActive()) {
            return "<label class='label label-success'>".trans('labels.general.active').'</label>';
        }

        return "<label class='label label-danger'>".trans('labels.general.inactive').'</label>';
    }

    public function getDrugCostAttribute()
    {
       //dd($this->percent_markup);
        return  round($this->pharmacy_purchase_price + (($this->percent_markup / 100) * $this->pharmacy_purchase_price), 2); 
        
    }
    public function getPatientPaysAttribute()
    {
        
        return round($this->dispensing_fee + $this->delivery_cost+ $this->getDrugCostAttribute(), 2); 
        
    }
    public function getDrugStrengthAttribute()
    {
        
        return $this->strength .' '. $this->strength_unit; 
        
    }
    public function getDrugPackAttribute()
    {
        
        return $this->pack_size .' '. $this->packSize->name; 
        
    }

    /**
     * Get Statuses Attribute.
     *
     * @var string
     */
    public function getStatusesAttribute(): array
    {
        return $this->statuses;
    }
    public function getDrugsFormatsAttribute(): array
    {
        return $this->drugs_formats;
    }
    public function getStrengthUnitsAttribute(): array
    {
        return $this->strength_units;
    }
    public function getPackUnitsAttribute(): array
    {
        return $this->pack_units;
    }
    public function getInsuranceCoverageAttribute(): array
    {
        return $this->insurance_coverage_in_percent;
    }


    public function isActive()
    {
        return $this->status == 1;
    }
}
