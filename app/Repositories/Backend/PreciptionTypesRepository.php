<?php

namespace App\Repositories\Backend;

use App\Events\Backend\PreciptionTypes\PreciptionTypesCreated;
use App\Events\Backend\PreciptionTypes\PreciptionTypesDeleted;
use App\Events\Backend\PreciptionTypes\PreciptionTypesUpdated;
use App\Exceptions\GeneralException;
use App\Models\PreciptionType;
use App\Repositories\BaseRepository;
use Str;

class PreciptionTypesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = PreciptionType::class;

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
                'preciption_types.id',
                'preciption_types.preciption_type',
                'preciption_types.status',
                'preciption_types.created_by',
                'preciption_types.created_at',
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
                'preciption_types.id',
                'preciption_types.preciption_type',
                'preciption_types.status',
                'preciption_types.created_by',
                'preciption_types.created_at',
            ]);
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
        $input['slug'] = Str::slug($input['preciption_type']);
        $input['created_by'] = auth()->user()->id;
        $input['status'] = isset($input['status']) ? 1 : 0;

        if ($prescription = PreciptionType::create($input)) {
            event(new PreciptionTypesCreated($prescription));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.preciption-types.create_error'));
    }

    // /**
    //  * @param \App\Models\Prescription $prescription
    //  * @param array $input
    //  */
    public function update(PreciptionType $preciptionType, array $input)
    {
        // dd($input);

        if ($preciptionType->update($input)) {
            event(new PreciptionTypesUpdated($preciptionType));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.preciption-types.update_error'));
    }

    // /**
    //  * @param \App\Models\EnterpriseConnect $enterpriseConnect
    //  *
    //  * @throws GeneralException
    //  *
    //  * @return bool
    //  */
    public function delete($preciptionType)
    {
       // dd($preciptionType);
        if ($preciptionType->delete()) {
            event(new PreciptionTypesDeleted($preciptionType));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.email-templates.delete_error'));
    }
}
