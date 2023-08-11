<?php

namespace App\Http\Controllers\Backend\Drugs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Drugs\ManageDrugsRequest;
use App\Http\Requests\Backend\Drugs\StoreDrugsRequest;
use App\Http\Requests\Backend\Drugs\UpdateDrugsRequest;
use App\Http\Responses\Backend\Drug\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Drug;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Repositories\Backend\DrugsRepository;
use Illuminate\Support\Facades\View;

class DrugsController extends Controller
{
    /**
     * @var \App\Repositories\Backend\DrugsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\DrugsRepository $blog
     */
    public function __construct(DrugsRepository $repository)
    {
        
        $this->repository = $repository;
        View::share('js', ['drugs']);
    }

    /**
     * @param \App\Http\Requests\Backend\Drugs\ManageDrugsRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageDrugsRequest $request)
    {
        
        return new ViewResponse('backend.drugs.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Drugs\ManageDrugsRequest $request
     *
     * @return ViewResponse
     */
    public function create(ManageDrugsRequest $request, Drug $drug)
    {
        
        return new ViewResponse('backend.drugs.create', ['status' => $drug->statuses]);
    }

    

    /**
     * @param \App\Http\Requests\Backend\Drugs\StoreDrugsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreDrugsRequest $request)
    {
       $this->repository->create($request->except(['_token', '_method']));
        
        return new RedirectResponse(route('admin.drugs.index'), ['flash_success' => __('alerts.backend.drugs.created')]);
    }

    /**
     * @param \App\Models\Drug $drug
     * @param \App\Http\Requests\Backend\Drugs\ManageDrugsRequest $request
     *
     * @return \App\Http\Responses\Backend\Drug\EditResponse
     */
    public function edit(Drug $drug, ManageDrugsRequest $request)
    {
       

        return new EditResponse($drug, $drug->statuses);
    }

    /**
     * @param \App\Models\Blogs\Drug $drug
     * @param \App\Http\Requests\Backend\Drugs\UpdateDrugsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Drug $drug, UpdateDrugsRequest $request)
    {
        $this->repository->update($drug, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.drugs.index'), ['flash_success' => __('alerts.backend.drugs.updated')]);
    }

    /**
     * @param \App\Models\Drug $drug
     * @param \App\Http\Requests\Backend\Drugs\ManageDrugsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Drug $drug, ManageDrugsRequest $request)
    {
        $this->repository->delete($drug);

        return new RedirectResponse(route('admin.drugs.index'), ['flash_success' => __('alerts.backend.drugs.deleted')]);
    }
}
