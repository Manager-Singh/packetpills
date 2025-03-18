<?php

namespace App\Http\Controllers\Backend\PrescriptionExistingRefill;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Prescriptions\ManagePrescriptionsRequest;
use App\Repositories\Backend\PrescriptionExistingRefillRepository;
use Yajra\DataTables\Facades\DataTables;

class PrescriptionExistingRefillTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\PrescriptionExistingRefillRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\PrescriptionExistingRefillRepository $repository
     */
    public function __construct(PrescriptionExistingRefillRepository $repository)
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
            ->addColumn('prescription_number', function ($prescriptions) {
                return isset($prescriptions->prescription_number) ? $prescriptions->prescription_number : '--';
            })
            ->addColumn('patient_name', function ($prescriptions) {
                return $prescriptions->user->first_name.' '.$prescriptions->user->last_name;
            })
            ->addColumn('medication_name', function ($prescriptions) {
                
                return isset($prescriptions->medication_name) ? $prescriptions->medication_name : '';
            })
            ->addColumn('created_at', function ($prescriptions) {
                return $prescriptions->created_at->toDateString();
            })
            ->addColumn('status', function ($prescriptions) {
                return ucfirst($prescriptions->status);
            })
            ->addColumn('actions', function ($prescriptions) {
                return '<div class="btn-group action-btn">
                    
                <a href="'.route('admin.auth.user.show', [$prescriptions->user, 'tab' => 'existingprescriptionrefill']).'" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'" class="btn btn-success btn-sm">
                    <i class="fas fa-eye"></i>
                </a> 
                </div>';
            })
            ->rawColumns(['actions']) 
            ->make(true);
    }
}
