<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Connect\SendConnectRequest;
use App\Repositories\Frontend\Connect\ConnectRepository;
use Illuminate\Http\Request;
//use App\Mail\Frontend\Connect\SendConnect;   ConnectRepository

/**
 * Class ContactController.
 */
class ConnectController extends Controller
{


    protected $connectRepository;
    public function __construct(ConnectRepository $connectRepository)
    {
        $this->connectRepository = $connectRepository;

    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.connect');
    }

    /**
     * @param SendContactRequest $request
     *
     * @return mixed
     */
    public function store(SendConnectRequest $request)
    {
        // die('sfd');
        // $validated = $request->validated();
       //dd($request->except('_token'));

        $connect = $this->connectRepository->create($request->except('_token'));
        // dd($connect);
       // Mail::send(new SendContact($request));

        return redirect()->back()->withFlashSuccess(__('alerts.frontend.contact.sent'));
    }
}
