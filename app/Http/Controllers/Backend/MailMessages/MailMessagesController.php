<?php

namespace App\Http\Controllers\Backend\MailMessages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\MailMessages\CreateMailMessagesRequest;
use App\Http\Requests\Backend\MailMessages\DeleteMailMessagesRequest;
use App\Http\Requests\Backend\MailMessages\ManageMailMessagesRequest;
use App\Http\Requests\Backend\MailMessages\StoreMailMessagesRequest;
use App\Http\Requests\Backend\MailMessages\UpdateMailMessagesRequest;
use App\Http\Responses\Backend\MailMessages\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\MailMessage;
use App\Repositories\Backend\MailMessagesRepository;
use Illuminate\Support\Facades\View;



class MailMessagesController extends Controller
{
    /**
     * @var \App\Repositories\Backend\MailMessagesRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\MailMessagesRepository $prescription
     */
    public function __construct(MailMessagesRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['mail-messages']);
    }

    /**
     * @param \App\Http\Requests\Backend\MailMessages\ManageMailMessagesRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageMailMessagesRequest $request)
    {
        return new ViewResponse('backend.mail-messages.index');
    }

    /**
     * @param \App\Http\Requests\Backend\MailMessages\CreateMailMessagesRequest
     *
     * @return ViewResponse
     */
    public function create(CreateMailMessagesRequest $request)
    {
        return new ViewResponse('backend.mail-messages.create');
    }

    // /**
    //  * @param \App\Http\Requests\Backend\MailMessages\StoreMailMessagesRequest $request
    //  *
    //  * @return \App\Http\Responses\RedirectResponse
    //  */
    public function store(StoreMailMessagesRequest $request)
    {
        $this->repository->create($request->except('token'));

        return new RedirectResponse(route('admin.mail-messages.index'), ['flash_success' => __('alerts.backend.mail-messages.created')]);
    }

    // /**
    //  * @param \App\Models\Prescription $MailMessages
    //  * @param \App\Http\Requests\Backend\MailMessages\ManageMailMessagesRequest $request
    //  *
    //  * @return mixed
    //  */
    // public function show($MailMessages)
    // {
    //     dd($MailMessages);
    //     $preciptionData = MailMessages::where('id',$MailMessages)->first();
    //     dd($preciptionData);
    //     // $data['prescription']   = EnterpriseConnect;
    //     // $data['drugs']          = EnterpriseConnect::get();
    //     // return view('backend.MailMessages.show',$data);
    // }

    // /**
    //  * @param \App\Models\Prescription $MailMessages
    //  * @param \App\Http\Requests\Backend\MailMessages\ManageMailMessagesRequest $request
    //  *
    //  * @return \App\Http\Responses\Backend\MailMessages\EditResponse
    //  */
    public function edit(MailMessage $MailMessage, ManageMailMessagesRequest $request)
    {
        return new EditResponse($MailMessage);
    }

    // /**
    //  * @param \App\Models\Prescription $prescription
    //  * @param \App\Http\Requests\Backend\MailMessages\UpdateMailMessagesRequest $request
    //  *
    //  * @return \App\Http\Responses\RedirectResponse
    //  */
    public function update(MailMessage $MailMessage, UpdateMailMessagesRequest $request)
    {
        // print_r($request->all());
        // die;
        $this->repository->update($MailMessage, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.mail-messages.index'), ['flash_success' => __('alerts.backend.mail-messages.updated')]);
    }

    /**
     * @param \App\Models\MailMessages $MailMessages
     * @param \App\Http\Requests\Backend\MailMessages\DeleteMailMessagesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(MailMessage $MailMessage,DeleteMailMessagesRequest $request)
    {
        // dd($AutoMessage);
        $this->repository->delete($MailMessage);
        return new RedirectResponse(route('admin.mail-messages.index'), ['flash_success' => __('alerts.backend.mail-messages.deleted')]);
    }
}
