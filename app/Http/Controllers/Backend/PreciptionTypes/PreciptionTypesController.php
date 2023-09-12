<?php

namespace App\Http\Controllers\Backend\PreciptionTypes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PreciptionTypes\CreatePreciptionTypesRequest;
use App\Http\Requests\Backend\PreciptionTypes\DeletePreciptionTypesRequest;
use App\Http\Requests\Backend\PreciptionTypes\ManagePreciptionTypesRequest;
use App\Http\Requests\Backend\PreciptionTypes\StorePreciptionTypesRequest;
use App\Http\Requests\Backend\PreciptionTypes\UpdatePreciptionTypesRequest;
use App\Http\Responses\Backend\PreciptionTypes\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\PreciptionType;
use App\Repositories\Backend\PreciptionTypesRepository;
use Illuminate\Support\Facades\View;



class PreciptionTypesController extends Controller
{
    /**
     * @var \App\Repositories\Backend\PrescriptionsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\PrescriptionsRepository $prescription
     */
    public function __construct(PreciptionTypesRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['preciption-types']);
    }

    /**
     * @param \App\Http\Requests\Backend\Prescriptions\ManagePreciptionTypesRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManagePreciptionTypesRequest $request)
    {
        return new ViewResponse('backend.preciption-types.index');
    }

    /**
     * @param \App\Http\Requests\Backend\PreciptionTypes\CreatePreciptionTypesRequest
     *
     * @return ViewResponse
     */
    public function create(CreatePreciptionTypesRequest $request)
    {
        return new ViewResponse('backend.preciption-types.create');
    }

    // /**
    //  * @param \App\Http\Requests\Backend\Prescriptions\StorePrescriptionsRequest $request
    //  *
    //  * @return \App\Http\Responses\RedirectResponse
    //  */
    public function store(StorePreciptionTypesRequest $request)
    {
        $this->repository->create($request->except('token'));

        return new RedirectResponse(route('admin.preciption-types.index'), ['flash_success' => __('alerts.backend.preciption-types.created')]);
    }

    // /**
    //  * @param \App\Models\Prescription $prescriptions
    //  * @param \App\Http\Requests\Backend\Prescriptions\ManagePrescriptionsRequest $request
    //  *
    //  * @return mixed
    //  */
    // public function show($preciptionTypes)
    // {
    //     dd($preciptionTypes);
    //     $preciptionData = PreciptionTypes::where('id',$preciptionTypes)->first();
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
    public function edit(PreciptionType $preciptionType, ManagePreciptionTypesRequest $request)
    {
        return new EditResponse($preciptionType);
    }

    // /**
    //  * @param \App\Models\Prescription $prescription
    //  * @param \App\Http\Requests\Backend\Prescriptions\UpdatePreciptionTypesRequest $request
    //  *
    //  * @return \App\Http\Responses\RedirectResponse
    //  */
    public function update(PreciptionType $preciptionType, UpdatePreciptionTypesRequest $request)
    {
        $this->repository->update($preciptionType, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.preciption-types.index'), ['flash_success' => __('alerts.backend.preciption-types.updated')]);
    }

    /**
     * @param \App\Models\preciptionTypes $preciptionTypes
     * @param \App\Http\Requests\Backend\Prescriptions\DeletePreciptionTypesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(PreciptionType $preciptionType,DeletePreciptionTypesRequest $request)
    {
        // dd($preciptionType);
        $this->repository->delete($preciptionType);
        return new RedirectResponse(route('admin.preciption-types.index'), ['flash_success' => __('alerts.backend.preciption-types.deleted')]);
    }
}
