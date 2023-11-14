<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Prescriptions\PrescriptionCreated;
use App\Events\Backend\Prescriptions\PrescriptionDeleted;
use App\Events\Backend\Prescriptions\PrescriptionUpdated;
use App\Exceptions\GeneralException;
use App\Models\TransferRequest;
use App\Repositories\BaseRepository;
use Str;

class TransferRequestsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = TransferRequest::class;

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
            ->select([
               
                'transfer_requests.id',
                'transfer_requests.name',
                'transfer_requests.formatted_address',
                'transfer_requests.formatted_phone_number',
                'transfer_requests.fax_number',
                'transfer_requests.created_at',
                'transfer_requests.status',
            ])->with('owner')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                
                'transfer_requests.id',
                'transfer_requests.name',
                'transfer_requests.formatted_address',
                'transfer_requests.formatted_phone_number',
                'transfer_requests.fax_number',
                'transfer_requests.created_at',
                'transfer_requests.status',
            ])->with('owner');
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
        dd($input);

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

    /**
     * @param 
     * @param array $input
     */
    public function faxNumberUpdate(array $input)
    {
        
        $transfer_request = self::find($input['id']);
        $transfer_request->fax_number = $input['fax_number'];
        if ($transfer_request->save()) {
           return true;
        }else{
            return false;
        }
    }
}
