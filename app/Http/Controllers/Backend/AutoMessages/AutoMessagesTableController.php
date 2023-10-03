<?php

namespace App\Http\Controllers\Backend\AutoMessages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AutoMessages\ManageAutoMessagesRequest;
use App\Repositories\Backend\AutoMessagesRepository;
use Yajra\DataTables\Facades\DataTables;

class AutoMessagesTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\AutoMessagesTableController
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\AutoMessagesRepository $repository
     */
    public function __construct(AutoMessagesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Prescriptions\ManageAutoMessagesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageAutoMessagesRequest $request)
    {
        
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['message'])
            ->addColumn('message', function ($AutoMessages) {
               
                return $AutoMessages->message;
            })
            ->addColumn('status', function ($AutoMessages) {
                return $AutoMessages->display_status;
            })
            ->addColumn('created_at', function ($AutoMessages) {
                return $AutoMessages->created_at->toDateString();
            })
            ->addColumn('actions', function ($AutoMessages) {
                return $AutoMessages->action_buttons;
            })
            ->make(true);
    }
}
