<?php

namespace App\Http\Controllers\Backend\AutoMessages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AutoMessages\CreateAutoMessagesRequest;
use App\Http\Requests\Backend\AutoMessages\DeleteAutoMessagesRequest;
use App\Http\Requests\Backend\AutoMessages\ManageAutoMessagesRequest;
use App\Http\Requests\Backend\AutoMessages\StoreAutoMessagesRequest;
use App\Http\Requests\Backend\AutoMessages\UpdateAutoMessagesRequest;
use App\Http\Responses\Backend\AutoMessages\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\AutoMessage;
use App\Repositories\Backend\AutoMessagesRepository;
use Illuminate\Support\Facades\View;



class AutoMessagesController extends Controller
{
    /**
     * @var \App\Repositories\Backend\AutoMessagesRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\AutoMessagesRepository $prescription
     */
    public function __construct(AutoMessagesRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['auto-messages']);
    }

    /**
     * @param \App\Http\Requests\Backend\AutoMessages\ManageAutoMessagesRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageAutoMessagesRequest $request)
    {
        return new ViewResponse('backend.auto-messages.index');
    }

    /**
     * @param \App\Http\Requests\Backend\AutoMessages\CreateAutoMessagesRequest
     *
     * @return ViewResponse
     */
    public function create(CreateAutoMessagesRequest $request)
    {
        return new ViewResponse('backend.auto-messages.create');
    }

    // /**
    //  * @param \App\Http\Requests\Backend\AutoMessages\StoreAutoMessagesRequest $request
    //  *
    //  * @return \App\Http\Responses\RedirectResponse
    //  */
    public function store(StoreAutoMessagesRequest $request)
    {
        $this->repository->create($request->except('token'));

        return new RedirectResponse(route('admin.auto-messages.index'), ['flash_success' => __('alerts.backend.auto-messages.created')]);
    }

    // /**
    //  * @param \App\Models\Prescription $AutoMessages
    //  * @param \App\Http\Requests\Backend\AutoMessages\ManageAutoMessagesRequest $request
    //  *
    //  * @return mixed
    //  */
    // public function show($AutoMessages)
    // {
    //     dd($AutoMessages);
    //     $preciptionData = AutoMessages::where('id',$AutoMessages)->first();
    //     dd($preciptionData);
    //     // $data['prescription']   = EnterpriseConnect;
    //     // $data['drugs']          = EnterpriseConnect::get();
    //     // return view('backend.AutoMessages.show',$data);
    // }

    // /**
    //  * @param \App\Models\Prescription $AutoMessages
    //  * @param \App\Http\Requests\Backend\AutoMessages\ManageAutoMessagesRequest $request
    //  *
    //  * @return \App\Http\Responses\Backend\AutoMessages\EditResponse
    //  */
    public function edit(PreciptionType $preciptionType, ManageAutoMessagesRequest $request)
    {
        return new EditResponse($preciptionType);
    }

    // /**
    //  * @param \App\Models\Prescription $prescription
    //  * @param \App\Http\Requests\Backend\AutoMessages\UpdateAutoMessagesRequest $request
    //  *
    //  * @return \App\Http\Responses\RedirectResponse
    //  */
    public function update(PreciptionType $preciptionType, UpdateAutoMessagesRequest $request)
    {
        $this->repository->update($preciptionType, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.auto-messages.index'), ['flash_success' => __('alerts.backend.auto-messages.updated')]);
    }

    /**
     * @param \App\Models\AutoMessages $AutoMessages
     * @param \App\Http\Requests\Backend\AutoMessages\DeleteAutoMessagesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(PreciptionType $preciptionType,DeleteAutoMessagesRequest $request)
    {
        // dd($preciptionType);
        $this->repository->delete($preciptionType);
        return new RedirectResponse(route('admin.auto-messages.index'), ['flash_success' => __('alerts.backend.auto-messages.deleted')]);
    }
}
