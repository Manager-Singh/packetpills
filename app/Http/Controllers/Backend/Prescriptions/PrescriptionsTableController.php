<?php

namespace App\Http\Controllers\Backend\Prescriptions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Prescriptions\ManagePrescriptionsRequest;
use App\Repositories\Backend\PrescriptionsRepository;
use Yajra\DataTables\Facades\DataTables;

class PrescriptionsTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\PrescriptionsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\PrescriptionsRepository $repository
     */
    public function __construct(PrescriptionsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Prescriptions\ManagePrescriptionsRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManagePrescriptionsRequest $request)
    {
        $status = $request->input('status', '');
        return Datatables::of($this->repository->getForDataTable($status))
            ->escapeColumns(['name'])
            ->addColumn('prescription_id', function ($prescriptions) {
                return $prescriptions->id;
            })
            ->addColumn('prescription_number', function ($prescriptions) {
                return $prescriptions->prescription_number;
            })
            ->addColumn('created_at', function ($prescriptions) {
                return $prescriptions->created_at->toDateString();
            })
            ->addColumn('status', function ($prescriptions) {
                return '<span class="'.$prescriptions->status.'">'.ucfirst($prescriptions->status).'</span>';
            })
            ->addColumn('actions', function ($prescriptions) {
                return $prescriptions->action_buttons;
            })
            ->make(true);
    }
}
