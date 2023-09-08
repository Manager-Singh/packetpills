<?php

namespace App\Repositories\Backend;

use App\Events\Backend\EnterpriseConnects\EnterpriseConnectCreated;
use App\Events\Backend\EnterpriseConnects\EnterpriseConnectDeleted;
use App\Events\Backend\EnterpriseConnects\EnterpriseConnectUpdated;
use App\Exceptions\GeneralException;
use App\Models\EnterpriseConnect;
use App\Repositories\BaseRepository;
use Str;

class EnterpriseConnectsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = EnterpriseConnect::class;

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
                'enterprise_connects.id',
                'enterprise_connects.full_name',
                'enterprise_connects.company',
                'enterprise_connects.job_title',
                'enterprise_connects.email',
                'enterprise_connects.phone_no',
                'enterprise_connects.status',
                'enterprise_connects.created_at',
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
            ->select([
                'enterprise_connects.id',
                'enterprise_connects.full_name',
                'enterprise_connects.company',
                'enterprise_connects.job_title',
                'enterprise_connects.email',
                'enterprise_connects.phone_no',
                'enterprise_connects.status',
                'enterprise_connects.created_at',
            ]);
    }

    // /**
    //  * @param array $input
    //  *
    //  * @throws \App\Exceptions\GeneralException
    //  *
    //  * @return bool
    //  */
    // public function create(array $input)
    // {
    //     $input['slug'] = Str::slug($input['title']);
    //     $input['created_by'] = auth()->user()->id;
    //     $input['status'] = isset($input['status']) ? 1 : 0;

    //     if ($prescription = Prescription::create($input)) {
    //         event(new PrescriptionCreated($prescription));

    //         return true;
    //     }

    //     throw new GeneralException(__('exceptions.backend.email-templates.create_error'));
    // }

    // /**
    //  * @param \App\Models\Prescription $prescription
    //  * @param array $input
    //  */
    // public function update(Prescription $prescription, array $input)
    // {
    //     dd($input);

    //     if ($prescription->update($input)) {
    //         event(new PrescriptionUpdated($prescription));

    //         return true;
    //     }

    //     throw new GeneralException(__('exceptions.backend.email-templates.update_error'));
    // }

    // /**
    //  * @param \App\Models\EnterpriseConnect $enterpriseConnect
    //  *
    //  * @throws GeneralException
    //  *
    //  * @return bool
    //  */
    public function delete($enterpriseConnect)
    {
        $enterpriseData = EnterpriseConnect::where('id',$enterpriseConnect)->first();

        //dd($enterpriseData);
        if ($enterpriseData->delete()) {
            event(new EnterpriseConnectDeleted($enterpriseConnect));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.email-templates.delete_error'));
    }
}
