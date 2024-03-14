<?php
namespace App\Models;
use App\Models\Prescription;
use App\Models\Auth\User;
use App\Models\MedicationItem;
class PrescriptionRefill extends BaseModel
{
   
    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'prescription_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function medication()
    {
        return $this->belongsTo(MedicationItem::class, 'medication_id');
    }
    
    public function getActionButtonsAttribute()
    {
        //dd($this->user);
        return '<div class="btn-group action-btn">
                    
                <a href="'.route('admin.auth.user.show', $this->user).'" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'" class="btn btn-success btn-sm">
                    <i class="fas fa-eye"></i>
                </a> 
                </div>';

                // return '<div class="btn-group action-btn">
                //     '.$this->getViewButtonAttribute('view-prescription', 'admin.prescriptions.show').'
                //     '.$this->getEditButtonAttribute('edit-prescription', 'admin.prescriptions.edit').'
                //     '.$this->getDeleteButtonAttribute('delete-prescription', 'admin.prescriptions.destroy').'
                    
                // </div>';
    }
}
