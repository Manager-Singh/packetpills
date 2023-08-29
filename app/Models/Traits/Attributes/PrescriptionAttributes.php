<?php

namespace App\Models\Traits\Attributes;

trait PrescriptionAttributes
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                    '.$this->getViewButtonAttribute('view-prescription', 'admin.prescriptions.show').'
                    '.$this->getEditButtonAttribute('edit-prescription', 'admin.prescriptions.edit').'
                    '.$this->getDeleteButtonAttribute('delete-prescription', 'admin.prescriptions.destroy').'
                    
                </div>';
    }
    
   

    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        if ($this->isActive()) {
            return "<label class='label label-success'>".trans('labels.general.active').'</label>';
        }

        return "<label class='label label-danger'>".trans('labels.general.inactive').'</label>';
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 1;
    }
}
