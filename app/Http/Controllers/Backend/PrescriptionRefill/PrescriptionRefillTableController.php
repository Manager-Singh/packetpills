<?php

namespace App\Http\Controllers\Backend\PrescriptionRefill;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Prescriptions\ManagePrescriptionsRequest;
use App\Repositories\Backend\PrescriptionRefillRepository;
use Yajra\DataTables\Facades\DataTables;

class PrescriptionRefillTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\PrescriptionRefillRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\PrescriptionRefillRepository $repository
     */
    public function __construct(PrescriptionRefillRepository $repository)
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
            ->addColumn('prescription_number', function ($prescriptions) {
                return isset($prescriptions->prescription->prescription_number) ? $prescriptions->prescription->prescription_number : '--';
            })
            ->addColumn('medication', function ($prescriptions) {
                $medica =[];
                // if(isset($prescriptions->prescription->medications)){
                //     foreach($prescriptions->prescription->medications as $medication){
                //       $medica[] = $medication->drug_name;
                //     }
                // }
                // return implode(', ',$medica);
                return isset($prescriptions->medication->drug_name) ? $prescriptions->medication->drug_name : '';
            })
            ->addColumn('created_at', function ($prescriptions) {
                return $prescriptions->created_at->toDateString();
            })
            ->addColumn('status', function ($prescriptions) {
                return ucfirst($prescriptions->status);
            })
            ->addColumn('actions', function ($prescriptions) {
                return '<div class="btn-group action-btn">
                    
                <a href="'.route('admin.auth.user.show', [$prescriptions->user, 'tab' => 'prescriptionrefill']).'" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'" class="btn btn-success btn-sm">
                    <i class="fas fa-eye"></i>
                </a> 
                </div>';
            })
            ->make(true);
    }
}
