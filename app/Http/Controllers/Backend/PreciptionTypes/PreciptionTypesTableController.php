<?php

namespace App\Http\Controllers\Backend\PreciptionTypes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PreciptionTypes\ManagePreciptionTypesRequest;
use App\Repositories\Backend\PreciptionTypesRepository;
use Yajra\DataTables\Facades\DataTables;

class PreciptionTypesTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\PreciptionTypesTableController
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\PreciptionTypesRepository $repository
     */
    public function __construct(PreciptionTypesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Prescriptions\ManagePreciptionTypesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManagePreciptionTypesRequest $request)
    {
        
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['preciption_type'])
            ->addColumn('preciption_type', function ($PreciptionTypes) {
               
                return $PreciptionTypes->preciption_type;
            })
            ->addColumn('status', function ($PreciptionTypes) {
                return $PreciptionTypes->display_status;
            })
            ->addColumn('created_at', function ($PreciptionTypes) {
                return $PreciptionTypes->created_at->toDateString();
            })
            ->addColumn('actions', function ($PreciptionTypes) {
                return $PreciptionTypes->action_buttons;
            })
            ->make(true);
    }
}
