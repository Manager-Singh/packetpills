<?php

namespace App\Models\Traits\Attributes;

trait EnterpriseConnectAttributes
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
     
        return '<div class="btn-group action-btn">
        '.$this->getViewButtonAttribute('view-enterpriseconnects', 'admin.enterpriseconnects.show').'
                    '.$this->getDeleteButtonAttribute('delete-enterpriseconnects', 'admin.enterpriseconnects.destroy').'
                    
                </div>';
    }
    
    //  '.$this->getViewButtonAttribute('view-prescription', 'admin.prescriptions.show').'
 //   '.$this->getEditButtonAttribute('edit-prescription', 'admin.prescriptions.edit').'
   

    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        if ($this->isConnected()) {
            return "<label class='label label-success'>".trans('labels.general.connected').'</label>';
        }

        return "<label class='label label-danger'>".trans('labels.general.notconnected').'</label>';
    }
    public function getPhoneNumberAttribute()
    {
        return '<a href="tel:'.$this->phone_no.'">'.$this->phone_no.'</a>';
    }

    /**
     * @return bool
     */
    public function isConnected()
    {
        return $this->status == 'connected';
    }
}
