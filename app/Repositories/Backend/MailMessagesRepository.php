<?php

namespace App\Repositories\Backend;

use App\Events\Backend\MailMessages\MailMessagesCreated;
use App\Events\Backend\MailMessages\MailMessagesDeleted;
use App\Events\Backend\MailMessages\MailMessagesUpdated;
use App\Exceptions\GeneralException;
use App\Models\MailMessage;
use App\Repositories\BaseRepository;
use Str;

class MailMessagesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = MailMessage::class;

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
                'message_for',
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
                'message_for',
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

        if ($MailMessage = MailMessage::create($input)) {
            event(new MailMessagesCreated($MailMessage));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.preciption-types.create_error'));
    }

    // /**
    //  * @param \App\Models\Prescription $prescription
    //  * @param array $input
    //  */
    public function update(MailMessage $MailMessage, array $input)
    {
        $input['status'] = isset($input['status']) ? 1 : 0;

        if ($MailMessage->update($input)) {
            event(new MailMessagesUpdated($MailMessage));

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
    public function delete($MailMessage)
    {
       // dd($MailMessage);
        if ($MailMessage->delete()) {
            event(new MailMessagesDeleted($MailMessage));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.email-templates.delete_error'));
    }
}
