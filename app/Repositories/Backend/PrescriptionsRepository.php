<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Prescriptions\PrescriptionCreated;
use App\Events\Backend\Prescriptions\PrescriptionDeleted;
use App\Events\Backend\Prescriptions\PrescriptionUpdated;
use App\Exceptions\GeneralException;
use App\Models\Prescription;
use App\Repositories\BaseRepository;
use Str;

class PrescriptionsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Prescription::class;

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
    public function getForDataTable()
    {
       return $this->query()
            ->has('user')
            ->select([
                'prescriptions.id',
                'prescriptions.prescription_number',
                'prescriptions.user_id',
                'prescriptions.created_at',
            ])->with('user')->orderBy('created_at', 'desc');
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        $input['slug'] = Str::slug($input['title']);
        $input['created_by'] = auth()->user()->id;
        $input['status'] = isset($input['status']) ? 1 : 0;

        if ($prescription = Prescription::create($input)) {
            event(new PrescriptionCreated($prescription));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.email-templates.create_error'));
    }

    /**
     * @param \App\Models\Prescription $prescription
     * @param array $input
     */
    public function update(Prescription $prescription, array $input)
    {
        
        if ($prescription->update($input)) {
            event(new PrescriptionUpdated($prescription));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.email-templates.update_error'));
    }

    /**
     * @param \App\Models\Prescription $prescription
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Prescription $prescription)
    {
        if ($rescription->delete()) {
            event(new PrescriptionDeleted($prescription));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.email-templates.delete_error'));
    }
}
