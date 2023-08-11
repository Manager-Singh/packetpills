<?php

namespace App\Http\Controllers\Backend\Drugs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Drugs\ManageDrugsRequest;
use App\Repositories\Backend\DrugsRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class DrugsTableController.
 */
class DrugsTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\DrugsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\DrugsRepository $repository
     */
    public function __construct(DrugsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Drugs\ManageDrugsRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageDrugsRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($drugs) {
                return $drugs->status;
            })
            ->addColumn('available_form', function ($drugs) {
                return $drugs->available_form;
            })
            ->addColumn('strength', function ($drugs) {
                return $drugs->strength;
            })
            ->addColumn('description', function ($drugs) {
                return $drugs->description;
            })
            ->addColumn('created_at', function ($drugs) {
                return $drugs->created_at->toDateString();
            })
            ->addColumn('actions', function ($drugs) {
                return $drugs->action_buttons;
            })
            ->make(true);
    }
}
