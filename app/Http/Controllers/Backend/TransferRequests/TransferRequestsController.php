<?php

namespace App\Http\Controllers\Backend\TransferRequests;

use App\Http\Controllers\Controller;
use App\Models\TransferRequest;
use App\Repositories\Backend\TransferRequestsRepository;
use Illuminate\Support\Facades\View;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Requests\Backend\TransferRequests\ManageTransferRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class TransferRequestsController extends Controller
{
    /**
     * @var \App\Repositories\Backend\TransferRequestsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\TransferRequestsRepository $prescription
     */
    public function __construct(TransferRequestsRepository $repository)
    {
        
        $this->repository = $repository;
        View::share('js', ['transfer-requests']);
        
    }

    /**
     * @param \App\Http\Requests\Backend\Prescriptions\ManageTransferRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageTransferRequest $request)
    {
        $name = Route::currentRouteName();
        //dd($name);
        return new ViewResponse('backend.transfer-request.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Prescriptions\CreatePrescriptionsRequest
     *
     * @return ViewResponse
     */
    public function create(CreatePrescriptionsRequest $request)
    {
        return new ViewResponse('backend.prescriptions.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Prescriptions\StorePrescriptionsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StorePrescriptionsRequest $request)
    {
        $this->repository->create($request->except('token'));

        return new RedirectResponse(route('admin.prescriptions.index'), ['flash_success' => __('alerts.backend.prescriptions.created')]);
    }

    /**
     * @param \App\Models\Prescription $prescriptions
     * @param \App\Http\Requests\Backend\Prescriptions\ManagePrescriptionsRequest $request
     *
     * @return mixed
     */
    public function show(Prescription $prescription, ManagePrescriptionsRequest $request)
    {
        $data['prescription']   = $prescription;
        $data['drugs']          = Drug::get();
        return view('backend.prescriptions.show',$data);
    }

    /**
     * @param \App\Models\Prescription $prescriptions
     * @param \App\Http\Requests\Backend\Prescriptions\ManagePrescriptionsRequest $request
     *
     * @return \App\Http\Responses\Backend\Prescriptions\EditResponse
     */
    public function edit(Prescription $prescription, ManagePrescriptionsRequest $request)
    {
        return new EditResponse($prescription);
    }

    /**
     * @param \App\Models\Prescription $prescription
     * @param \App\Http\Requests\Backend\Prescriptions\UpdatePrescriptionsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Prescription $prescription, UpdatePrescriptionsRequest $request)
    {
        $this->repository->update($prescription, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.prescriptions.index'), ['flash_success' => __('alerts.backend.prescriptions.updated')]);
    }

    /**
     * @param \App\Models\Prescription $prescription
     * @param \App\Http\Requests\Backend\Prescriptions\DeletePrescriptionsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Prescription $prescription, DeletePrescriptionsRequest $request)
    {
        $this->repository->delete($prescription);

        return new RedirectResponse(route('admin.prescriptions.index'), ['flash_success' => __('alerts.backend.prescriptions.deleted')]);
    }


    public function faxNumberUpdate(Request $request)
    {
        //dd($request->all());
        $data = $this->repository->faxNumberUpdate($request->except(['_token', '_method']));
        
        if($data){
            return redirect()->back()->withFlashSuccess(__('Fax Number Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        
    }
}
