<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Http\Requests\Backend\Auth\User\StoreUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserRequest;
use App\Http\Responses\ViewResponse;
use App\Models\Auth\User;
use App\Models\Province;
use App\Models\AutoMessage;
use App\Models\Drug;
use App\Models\TransferRequest;
use App\Models\Prescription;
use App\Models\MedicationItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\UserRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Auth\UserRepository
     */
    protected $userRepository;

    /**
     * @var \App\Repositories\Backend\Auth\RoleRepository
     */
    protected $roleRepository;

    /**
     * @param \App\Repositories\Backend\Auth\UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        View::share('js', ['users']);
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\User\ManageUserRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageUserRequest $request)
    {
        return new ViewResponse('backend.auth.user.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\User\ManageUserRequest $request
     *
     * @return mixed
     */
    public function create(ManageUserRequest $request)
    {
        $province = Province::get()->pluck('name','name');
        return view('backend.auth.user.create')
            ->with([
                'provinces'=>$province,
            ])
            ->withRoles($this->roleRepository->getAll());
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\User\StoreUserRequest $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userRepository->create($request->except(['_token', '_method','files']),$request->file('files'), $request->has('avatar_location') ? $request->file('avatar_location') : false);
      //  $user->id;
       // route('admin.auth.user.show', $this)
        return redirect()->route('admin.auth.user.show', $user)->withFlashSuccess(__('alerts.backend.access.users.created'));
    }

    public function create_prescription(Request $request)
    {
        $this->userRepository->create_prescription($request->except(['_token', '_method','files']),$request->file('files'));

        return redirect()->back()->withFlashSuccess(__('Prescription Successfully Created.'));
    }
    public function create_healthcard(Request $request)
    {
        $this->userRepository->create_healthcard($request->except(['_token', '_method','files']),$request->file('files'));

        return redirect()->back()->with('tab','healthcard')->withFlashSuccess(__('Health Card Successfully Created.'));
    }
    public function create_insurance(Request $request)
    {
        $this->userRepository->create_insurance($request->except(['_token', '_method','files']),$request->file('files'));

        return redirect()->back()->with('tab','insurance')->withFlashSuccess(__(' Insurance Successfully Updated.'));
    }
    

    public function create_address(Request $request)
    {
        $this->userRepository->create_address($request->except(['_token', '_method']));

        return redirect()->back()->with('tab','address')->withFlashSuccess(__('Address Successfully Created.'));
    }
    public function edit_address(Request $request)
    {
        $this->userRepository->edit_address($request->except(['_token', '_method']));

        return redirect()->back()->with('tab','address')->withFlashSuccess(__('Address Successfully Edited.'));
    }

    public function healthinformation(Request $request)
    {
        $this->userRepository->healthinformation($request->except(['_token', '_method']));

        return redirect()->back()->with('tab','healthinformation')->withFlashSuccess(__('Health Information Successfully Updated.'));
    }
    public function paymentmethod(Request $request)
    {
       $this->userRepository->paymentmethod($request->except(['_token', '_method','files']),$request->file('files'));

        return redirect()->back()->with('tab','paymentmethod')->withFlashSuccess(__('Payment Method Successfully Created.'));
    }
    public function edit_paymentmethod(Request $request)
    {
        $pfile = 'files_'.$request->payment_method_id;

        // print_r($request->file($pfile));
        // die;
       $this->userRepository->edit_paymentmethod($request->except(['_token', '_method','files']),$request->file($pfile));

        return redirect()->back()->with('tab','paymentmethod')->withFlashSuccess(__('Payment Method Successfully Updated.'));
    }
    public function create_medication(Request $request)
    {
       $this->userRepository->create_medication($request->except(['_token', '_method']));

        return redirect()->back()->with('tab','overview')->withFlashSuccess(__('Medication Successfully Created.'));
    }
    public function createMedicationOrder(Request $request)
    {
       $this->userRepository->createMedicationOrder($request->except(['_token', '_method']));

        return redirect()->back()->with('tab','orders')->withFlashSuccess(__('Medication Order Successfully Created.'));
    }

    
    
    
    public function send_message(Request $request)
    {
       
            
            if($request->isSmsChecked=='true'){
                $response_data = sendMessage($request->dialingCode.$request->mobile_no,'admin',null,$request->message);
            }

            if($request->isEmailChecked=='true'){
                $response_data = sendMail('admin',null,$request->message,$request->user_id);
            }

            return $response_data;
            
     }

    
    public function send_insurance_status(Request $request)
    {
            // print_r($request->all());
            // die;
            User::where('id',$request->user_id)->update(array('is_insurance' => $request->insurance_val));
            return 1;
            
     }
    
    public function delete_payment_method($id)
    {
        $datat = $this->userRepository->delete_payment_method($id);

        return $datat;
    }
    
    public function delete_address($id)
    {
        $datat = $this->userRepository->delete_address($id);

        return $datat;
    }

    


    

    

    /**
     * @param \App\Http\Requests\Backend\Auth\User\ManageUserRequest $request
     * @param \App\Models\Auth\User $user
     *
     * @return mixed
     */
    public function show(ManageUserRequest $request, User $user)
    {
        // print_r($user->id);
        // die;
        $auto_messages = AutoMessage::get()->pluck('message','id');
        $drugs = Drug::get()->pluck('brand_name','id');
        $province = Province::get()->pluck('name','name');
        $prescriptions = Prescription::where('user_id',$user->id)->where('status','approved')->with('medications')->has('medications')->get();
        $aaprescriptions = Prescription::where('user_id',$user->id)->get();
        $orders = Order::where('user_id',$user->id)->with(['prescription','order_items','order_items.medication','order_items.medication.prescription'])->has('order_items')->get();
        $transferRequests = TransferRequest::where('user_id',$user->id)->get();


        //  print_r('<pre>');
        //  print_r($orders);
        //   die;
        return view('backend.auth.user.show')
            ->with([
                'provinces'=>$province,
                'auto_messages'=>$auto_messages,
                'drugs'=>$drugs,
                'prescriptions'=>$prescriptions,
                'aaprescriptions'=>$aaprescriptions,
                'orders'=>$orders,
                'transferRequests'=>$transferRequests,
            ])
            ->withUser($user);
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\User\ManageUserRequest $request
     * @param \App\Models\Auth\User $user
     *
     * @return mixed
     */
    public function edit(ManageUserRequest $request, User $user, PermissionRepository $permissionRepository)
    {

        $province = Province::get()->pluck('name','name');
            
        return view('backend.auth.user.edit')
            ->with([
                'provinces'=>$province,
            ])
            ->withUser($user)
            ->withUserRoles($user->roles->pluck('id')->all())
            ->withRoles($this->roleRepository->getAll())
            ->withPermissions($permissionRepository->getSelectData('display_name'))
            ->withUserPermissions($user->permissions->pluck('id')->all());
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\User\UpdateUserRequest $request
     * @param \App\Models\Auth\User $user
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        
        $user  = $this->userRepository->update($user, $request->except(['_token', '_method','files']),$request->has('avatar_location') ? $request->file('avatar_location') : false);
      //  ->route('admin.auth.user.show', $user)
        return redirect()->route('admin.auth.user.show', $user)->withFlashSuccess(__('alerts.backend.access.users.updated'));
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\User\ManageUserRequest $request
     * @param \App\Models\Auth\User $user
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy(ManageUserRequest $request, User $user)
    {
        $this->userRepository->delete($user);

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('alerts.backend.access.users.deleted'));
    }
      public function prescriptionStatusUpdate(Request $request)
        {
           $data = $this->userRepository->prescriptionStatusUpdate($request->except(['_token', '_method','files']));

            return $data;
        }
        public function orderStatusUpdate(Request $request)
        {
           $data = $this->userRepository->orderStatusUpdate($request->except(['_token', '_method','files']));

            return $data;
        }
        public function transferStatusUpdate(Request $request)
        {
           $data = $this->userRepository->transferStatusUpdate($request->except(['_token', '_method','files']));

            return $data;
        }

        
}
