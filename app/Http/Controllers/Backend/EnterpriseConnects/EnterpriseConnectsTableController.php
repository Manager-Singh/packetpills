<?php

namespace App\Http\Controllers\Backend\EnterpriseConnects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\EnterpriseConnects\ManageEnterpriseConnectsRequest;
use App\Repositories\Backend\EnterpriseConnectsRepository;
use Yajra\DataTables\Facades\DataTables;

class EnterpriseConnectsTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\EnterpriseConnectsTableController
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\EnterpriseConnectsRepository $repository
     */
    public function __construct(EnterpriseConnectsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Prescriptions\ManageEnterpriseConnectsRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageEnterpriseConnectsRequest $request)
    {
        
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['full_name'])
            ->addColumn('full_name', function ($enterpriseConnects) {
               
                return $enterpriseConnects->full_name;
            })
            ->addColumn('company', function ($enterpriseConnects) {
                return $enterpriseConnects->company;
            })
            ->addColumn('job_title', function ($enterpriseConnects) {
                return $enterpriseConnects->job_title;
            })
            ->addColumn('email', function ($enterpriseConnects) {
                return $enterpriseConnects->email;
            })
            ->addColumn('phone_no', function ($enterpriseConnects) {
                return $enterpriseConnects->phone_number;
            })
            ->addColumn('status', function ($enterpriseConnects) {
                return $enterpriseConnects->status_label;
            })
            ->addColumn('created_at', function ($enterpriseConnects) {
                return $enterpriseConnects->created_at->toDateString();
            })
            ->addColumn('actions', function ($enterpriseConnects) {
                return $enterpriseConnects->action_buttons;
            })
            ->make(true);
    }
}
