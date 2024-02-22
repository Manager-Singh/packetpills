<?php

namespace App\Models;

//use App\Models\Traits\Attributes\OrderAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\OrderRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends BaseModel
{

    //OrderAttributes
    use ModelAttributes, SoftDeletes, OrderRelationships;

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
     /**
     * Appends.
     *
     * @var array
     */
    protected $appends = [
        'display_status',
    ];

    public static function generateOrderNumber()
    {
        $date = now()->format('Ymd');
        $lastOrder = self::latest()->first();

        if ($lastOrder) {
            $lastNumber = $lastOrder->order_number;
            // $lastNumber = end($lastNumber);
            $nextNumber = str_pad($lastNumber + 1, 10, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0000000001';
        }

        //return "ODR-$nextNumber";
        return "$nextNumber";
    }

    public function getActionButtonsAttribute()
    {
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

    public function getDisplayStatusAttribute(){
        return 'staussss';
    }
}
