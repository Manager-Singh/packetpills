<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Prescriptions\PrescriptionCreated;
use App\Events\Backend\Prescriptions\PrescriptionDeleted;
use App\Events\Backend\Prescriptions\PrescriptionUpdated;
use App\Exceptions\GeneralException;
use App\Models\Prescription;
use App\Repositories\BaseRepository;
use Str;
use App\Models\PrescriptionOld;

class PrescriptionExistingRefillRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = PrescriptionOld::class;

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc')
    {
        return $this->query()
        ->has('user')
            ->select([
                'prescription_olds.id',
                'prescription_olds.prescription_number',
                'prescription_olds.medication_name',
                'prescription_olds.image',
                'prescription_olds.user_id',
                'prescription_olds.created_at',
            ])
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @return mixed
     */
    public function getForDataTable($status)
    {
       
       
        $query = $this->query()
            ->has('user')
            ->with(['user']);
            

            if($status === 'cancelled'){
                $query->where('status', 'cancelled');
            }else{
                $query->where('status', '!=', 'cancelled'); 
            }
            return $query->orderBy('created_at', 'desc');
    }



}
