<?php

namespace App\Http\Controllers\Backend\Provinces;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Provinces\ManageProvincesRequest;
use App\Repositories\Backend\ProvincesRepository;
use Yajra\DataTables\Facades\DataTables;

class ProvincesTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\ProvincesTableController
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\ProvincesRepository $repository
     */
    public function __construct(ProvincesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Prescriptions\ManageProvincesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageProvincesRequest $request)
    {
        
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('preciption_type', function ($Provinces) {
               
                return $Provinces->name;
            })
            ->addColumn('status', function ($Provinces) {
                return $Provinces->display_status;
            })
            ->addColumn('created_at', function ($Provinces) {
                return $Provinces->created_at->toDateString();
            })
            ->addColumn('actions', function ($Provinces) {
                return $Provinces->action_buttons;
            })
            ->make(true);
    }
}
