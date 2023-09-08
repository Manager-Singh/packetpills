<?php

namespace App\Http\Controllers\Backend\EnterpriseConnects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\EnterpriseConnects\CreateEnterpriseConnectsRequest;
use App\Http\Requests\Backend\EnterpriseConnects\DeleteEnterpriseConnectsRequest;
use App\Http\Requests\Backend\EnterpriseConnects\ManageEnterpriseConnectsRequest;
use App\Http\Requests\Backend\EnterpriseConnects\StoreEnterpriseConnectsRequest;
use App\Http\Requests\Backend\EnterpriseConnects\UpdateEnterpriseConnectsRequest;
use App\Http\Responses\Backend\EnterpriseConnects\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\EnterpriseConnect;
use App\Repositories\Backend\EnterpriseConnectsRepository;
use Illuminate\Support\Facades\View;



class EnterpriseConnectsController extends Controller
{
    /**
     * @var \App\Repositories\Backend\PrescriptionsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\PrescriptionsRepository $prescription
     */
    public function __construct(EnterpriseConnectsRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['enterprise-connects']);
    }

    /**
     * @param \App\Http\Requests\Backend\Prescriptions\ManageEnterpriseConnectsRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageEnterpriseConnectsRequest $request)
    {
        return new ViewResponse('backend.enterprise-connects.index');
    }

    // /**
    //  * @param \App\Http\Requests\Backend\Prescriptions\CreatePrescriptionsRequest
    //  *
    //  * @return ViewResponse
    //  */
    // public function create(CreatePrescriptionsRequest $request)
    // {
    //     return new ViewResponse('backend.prescriptions.create');
    // }

    // /**
    //  * @param \App\Http\Requests\Backend\Prescriptions\StorePrescriptionsRequest $request
    //  *
    //  * @return \App\Http\Responses\RedirectResponse
    //  */
    // public function store(StorePrescriptionsRequest $request)
    // {
    //     $this->repository->create($request->except('token'));

    //     return new RedirectResponse(route('admin.prescriptions.index'), ['flash_success' => __('alerts.backend.prescriptions.created')]);
    // }

    // /**
    //  * @param \App\Models\Prescription $prescriptions
    //  * @param \App\Http\Requests\Backend\Prescriptions\ManagePrescriptionsRequest $request
    //  *
    //  * @return mixed
    //  */
    public function show($enterpriseConnect)
    {
        $enterpriseData = EnterpriseConnect::where('id',$enterpriseConnect)->first();
        dd($enterpriseData);
        // $data['prescription']   = EnterpriseConnect;
        // $data['drugs']          = EnterpriseConnect::get();
        // return view('backend.prescriptions.show',$data);
    }

    // /**
    //  * @param \App\Models\Prescription $prescriptions
    //  * @param \App\Http\Requests\Backend\Prescriptions\ManagePrescriptionsRequest $request
    //  *
    //  * @return \App\Http\Responses\Backend\Prescriptions\EditResponse
    //  */
    // public function edit(Prescription $prescription, ManagePrescriptionsRequest $request)
    // {
    //     return new EditResponse($prescription);
    // }

    // /**
    //  * @param \App\Models\Prescription $prescription
    //  * @param \App\Http\Requests\Backend\Prescriptions\UpdatePrescriptionsRequest $request
    //  *
    //  * @return \App\Http\Responses\RedirectResponse
    //  */
    // public function update(Prescription $prescription, UpdatePrescriptionsRequest $request)
    // {
    //     $this->repository->update($prescription, $request->except(['_token', '_method']));

    //     return new RedirectResponse(route('admin.prescriptions.index'), ['flash_success' => __('alerts.backend.prescriptions.updated')]);
    // }

    /**
     * @param \App\Models\EnterpriseConnect $enterpriseConnect
     * @param \App\Http\Requests\Backend\Prescriptions\DeleteEnterpriseConnectsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(DeleteEnterpriseConnectsRequest $request,$enterpriseConnect)
    {
        //dd($enterpriseConnect);
        $this->repository->delete($enterpriseConnect);
        return new RedirectResponse(route('admin.enterpriseconnects.index'), ['flash_success' => __('alerts.backend.enterpriseconnects.deleted')]);
    }
}
