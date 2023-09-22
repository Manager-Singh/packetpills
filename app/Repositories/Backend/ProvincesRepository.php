<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Provinces\ProvincesCreated;
use App\Events\Backend\Provinces\ProvincesDeleted;
use App\Events\Backend\Provinces\ProvincesUpdated;
use App\Exceptions\GeneralException;
use App\Models\Province;
use App\Repositories\BaseRepository;
use Str;

class ProvincesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Province::class;

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
                'provinces.id',
                'provinces.name',
                'provinces.status',
                'provinces.created_by',
                'provinces.created_at',
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
                'provinces.id',
                'provinces.name',
                'provinces.status',
                'provinces.created_by',
                'provinces.created_at',
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
        $input['slug'] = Str::slug($input['name']);
        $input['created_by'] = auth()->user()->id;
        $input['status'] = isset($input['status']) ? 1 : 0;

        if ($Province = Province::create($input)) {
            event(new ProvincesCreated($Province));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.preciption-types.create_error'));
    }

    // /**
    //  * @param \App\Models\Prescription $prescription
    //  * @param array $input
    //  */
    public function update(Province $Province, array $input)
    {
        // dd($input);
        $input['slug'] = Str::slug($input['name']);
        if ($Province->update($input)) {
            event(new ProvincesUpdated($Province));

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
    public function delete($Province)
    {
       // dd($preciptionType);
        if ($Province->delete()) {
            event(new ProvincesDeleted($Province));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.email-templates.delete_error'));
    }
}
