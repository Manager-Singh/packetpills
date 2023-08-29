<?php

namespace App\Http\Controllers\Backend\Prescriptions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Prescriptions\CreatePrescriptionsRequest;
use App\Http\Requests\Backend\Prescriptions\DeletePrescriptionsRequest;
use App\Http\Requests\Backend\Prescriptions\ManagePrescriptionsRequest;
use App\Http\Requests\Backend\Prescriptions\StorePrescriptionsRequest;
use App\Http\Requests\Backend\Prescriptions\UpdatePrescriptionsRequest;
use App\Http\Responses\Backend\Prescriptions\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Prescription;
use App\Repositories\Backend\PrescriptionsRepository;
use Illuminate\Support\Facades\View;
use App\Models\Drug;


class PrescriptionsController extends Controller
{
    /**
     * @var \App\Repositories\Backend\PrescriptionsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\PrescriptionsRepository $prescription
     */
    public function __construct(PrescriptionsRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['prescriptions']);
    }

    /**
     * @param \App\Http\Requests\Backend\Prescriptions\ManagePrescriptionsRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManagePrescriptionsRequest $request)
    {
        return new ViewResponse('backend.prescriptions.index');
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
}
