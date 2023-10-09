<?php

namespace App\Http\Controllers\Backend\MailMessages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\MailMessages\ManageMailMessagesRequest;
use App\Repositories\Backend\MailMessagesRepository;
use Yajra\DataTables\Facades\DataTables;

class MailMessagesTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\MailMessagesTableController
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\MailMessagesRepository $repository
     */
    public function __construct(MailMessagesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Prescriptions\ManageMailMessagesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageMailMessagesRequest $request)
    {
        
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['message'])
            ->addColumn('message', function ($MailMessages) {
               
                return $MailMessages->message;
            })
            ->addColumn('message_for', function ($MailMessages) {
               
                return $MailMessages->message_for;
            })
            ->addColumn('status', function ($MailMessages) {
                return $MailMessages->display_status;
            })
            ->addColumn('created_at', function ($MailMessages) {
                return $MailMessages->created_at->toDateString();
            })
            ->addColumn('actions', function ($MailMessages) {
                return $MailMessages->action_buttons;
            })
            ->make(true);
    }
}
