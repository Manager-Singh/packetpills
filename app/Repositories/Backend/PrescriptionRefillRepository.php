<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Prescriptions\PrescriptionCreated;
use App\Events\Backend\Prescriptions\PrescriptionDeleted;
use App\Events\Backend\Prescriptions\PrescriptionUpdated;
use App\Exceptions\GeneralException;
use App\Models\Prescription;
use App\Repositories\BaseRepository;
use Str;
use App\Models\PrescriptionRefill;

class PrescriptionRefillRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = PrescriptionRefill::class;

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
                'prescriptions.id',
                'prescriptions.prescription_number',
                'prescriptions.user_id',
                'prescriptions.created_at',
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
            ->whereHas('medication')
            ->with(['prescription','user']);
            

            if($status === 'cancelled'){
                $query->where('status', 'cancelled');
            }
            return $query->orderBy('created_at', 'desc');
    }



}
