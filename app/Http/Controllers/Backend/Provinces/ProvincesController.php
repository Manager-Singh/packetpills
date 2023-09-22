<?php

namespace App\Http\Controllers\Backend\Provinces;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Provinces\CreateProvincesRequest;
use App\Http\Requests\Backend\Provinces\DeleteProvincesRequest;
use App\Http\Requests\Backend\Provinces\ManageProvincesRequest;
use App\Http\Requests\Backend\Provinces\StoreProvincesRequest;
use App\Http\Requests\Backend\Provinces\UpdateProvincesRequest;
use App\Http\Responses\Backend\Provinces\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Province;
use App\Repositories\Backend\ProvincesRepository;
use Illuminate\Support\Facades\View;



class ProvincesController extends Controller
{
    /**
     * @var \App\Repositories\Backend\PrescriptionsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\PrescriptionsRepository $prescription
     */
    public function __construct(ProvincesRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['provinces']);
    }

    /**
     * @param \App\Http\Requests\Backend\Prescriptions\ManageProvincesRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageProvincesRequest $request)
    {
        return new ViewResponse('backend.provinces.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Provinces\CreateProvincesRequest
     *
     * @return ViewResponse
     */
    public function create(CreateProvincesRequest $request)
    {
        return new ViewResponse('backend.provinces.create');
    }

    // /**
    //  * @param \App\Http\Requests\Backend\Prescriptions\StorePrescriptionsRequest $request
    //  *
    //  * @return \App\Http\Responses\RedirectResponse
    //  */
    public function store(StoreProvincesRequest $request)
    {
        $this->repository->create($request->except('token'));

        return new RedirectResponse(route('admin.provinces.index'), ['flash_success' => __('alerts.backend.provinces.created')]);
    }

    // /**
    //  * @param \App\Models\Prescription $prescriptions
    //  * @param \App\Http\Requests\Backend\Prescriptions\ManagePrescriptionsRequest $request
    //  *
    //  * @return mixed
    //  */
    // public function show($Provinces)
    // {
    //     dd($Provinces);
    //     $preciptionData = Provinces::where('id',$Provinces)->first();
    //     dd($preciptionData);
    //     // $data['prescription']   = EnterpriseConnect;
    //     // $data['drugs']          = EnterpriseConnect::get();
    //     // return view('backend.prescriptions.show',$data);
    // }

    // /**
    //  * @param \App\Models\Prescription $prescriptions
    //  * @param \App\Http\Requests\Backend\Prescriptions\ManagePrescriptionsRequest $request
    //  *
    //  * @return \App\Http\Responses\Backend\Prescriptions\EditResponse
    //  */
    public function edit(Province $province, ManageProvincesRequest $request)
    {
        return new EditResponse($province);
    }

    // /**
    //  * @param \App\Models\Prescription $prescription
    //  * @param \App\Http\Requests\Backend\Prescriptions\UpdateProvincesRequest $request
    //  *
    //  * @return \App\Http\Responses\RedirectResponse
    //  */
    public function update(Province $province, UpdateProvincesRequest $request)
    {
        $this->repository->update($province, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.provinces.index'), ['flash_success' => __('alerts.backend.provinces.updated')]);
    }

    /**
     * @param \App\Models\Provinces $Provinces
     * @param \App\Http\Requests\Backend\Prescriptions\DeleteProvincesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Province $province,DeleteProvincesRequest $request)
    {
        // dd($preciptionType);
        $this->repository->delete($province);
        return new RedirectResponse(route('admin.province.index'), ['flash_success' => __('alerts.backend.provinces.deleted')]);
    }
}
