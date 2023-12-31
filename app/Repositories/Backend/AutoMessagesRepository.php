<?php

namespace App\Repositories\Backend;

use App\Events\Backend\AutoMessages\AutoMessagesCreated;
use App\Events\Backend\AutoMessages\AutoMessagesDeleted;
use App\Events\Backend\AutoMessages\AutoMessagesUpdated;
use App\Exceptions\GeneralException;
use App\Models\AutoMessage;
use App\Repositories\BaseRepository;
use Str;

class AutoMessagesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = AutoMessage::class;

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
                'id',
                'message',
                'status',
                'created_by',
                'created_at',
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
                'id',
                'message',
                'status',
                'created_by',
                'created_at',
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
      //  $input['slug'] = Str::slug($input['preciption_type']);
        $input['created_by'] = auth()->user()->id;
        $input['status'] = isset($input['status']) ? 1 : 0;

        if ($AutoMessage = AutoMessage::create($input)) {
            event(new AutoMessagesCreated($AutoMessage));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.preciption-types.create_error'));
    }

    // /**
    //  * @param \App\Models\Prescription $prescription
    //  * @param array $input
    //  */
    public function update(AutoMessage $AutoMessage, array $input)
    {
        $input['status'] = isset($input['status']) ? 1 : 0;

        if ($AutoMessage->update($input)) {
            event(new AutoMessagesUpdated($AutoMessage));

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
    public function delete($AutoMessage)
    {
       // dd($AutoMessage);
        if ($AutoMessage->delete()) {
            event(new AutoMessagesDeleted($AutoMessage));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.email-templates.delete_error'));
    }
}
