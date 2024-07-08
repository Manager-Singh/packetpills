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
use App\Models\PrescriptionRefill;
use App\Models\PrescriptionOld;

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
    public function getEmployee(ManageUserRequest $request)
    {
        // print_r($this->repository->getEmployeePaginated(25, 'id', 'asc'));
        // die;
        return view('backend.auth.employee.employee');
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

    

    public function createEmployee(ManageUserRequest $request)
    {
        $province = Province::get()->pluck('name','name');
        return view('backend.auth.employee.create')
            ->with([
                'provinces'=>$province,
            ])
            ->withRoles($this->roleRepository->getAll());
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\User\ManageUserRequest $request
     *
     * @return mixed
     */
    public function memberCreate(ManageUserRequest $request,$user)
    {
        $province = Province::get()->pluck('name','name');
        return view('backend.auth.user.create')->with([
               'provinces'=>$province,
               'member_id'=>$user->id,
           ])->withRoles($this->roleRepository->getAll());
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
    public function storeEmployee(StoreUserRequest $request)
    {
        $user = $this->userRepository->createEmployee($request->except(['_token', '_method','files']), $request->has('avatar_location') ? $request->file('avatar_location') : false);
      //  $user->id;
       // route('admin.auth.user.show', $this)
        return redirect()->route('admin.auth.user.employee', $user)->withFlashSuccess(__('alerts.backend.access.users.created'));
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
        $this->userRepository->edit_paymentmethod($request->except(['_token', '_method','files']),$request->file($pfile));

        return redirect()->back()->with('tab','paymentmethod')->withFlashSuccess(__('Payment Method Successfully Updated.'));
    }
    public function create_medication(Request $request)
    {
       $this->userRepository->create_medication($request->except(['_token', '_method']));
       return redirect()->back()->with('tab','medications')->withFlashSuccess(__('Medication Successfully Created.'));
    }
    public function createMedicationOrder(Request $request)
    {
       $this->userRepository->createMedicationOrder($request->except(['_token', '_method']));

        return redirect()->back()->with('tab','orders')->withFlashSuccess(__('Medication Order Successfully Created.'));
    }

    
    
    
    public function send_message(Request $request)
    {
            $user = User::where('id',$request->user_id)->first();
            if(isset($user->parent_id) && !empty($user->parent_id)){ 
                $data =  ' to '.$user->full_name;
                $user = User::where('id',$user->parent_id)->first(); 
                $user_id = $user->id;
            }else{
                $data =  "";
                
            }
            
            if($request->isSmsChecked=='true'){
                $response_data = sendMessage($user->dialingCode.$user->mobile_no,'admin',null,$request->message);
            }

            if($request->isEmailChecked=='true'){
                $response_data = sendMail('admin',null,$request->message,$user->id,'Pharmacy');
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
        if (!$request->has('tab')) {
            // If 'tab' parameter is not present, remove 'tab' from session
            if (!session()->has('tab')) {
                $request->session()->forget('tab');
            }
            
        } else {
            $request->session()->put('tab', $request->input('tab'));
        }
        
        // print_r($user->id);
        // die;
        $auto_messages = AutoMessage::get()->pluck('message','id');
        $drugs = Drug::get()->pluck('brand_name','id');
        $province = Province::get()->pluck('name','slug');
        $prescriptions = Prescription::where('user_id',$user->id)->where('status','approved')->with(['medications'=> function ($query) {
            $query->where('status', '!=', 'cancelled');
        }])->whereHas('medications')->where('status','!=','cancelled')->orderBy('created_at','desc')->get();
        $aaprescriptions = Prescription::where('user_id',$user->id)->where('status','!=','cancelled')->orderBy('created_at','desc')->get();
        $orders = Order::where('user_id',$user->id)->with(['prescription','order_items','order_items.medication','order_items.medication.prescription'])->has('order_items')->where('order_status','!=','cancelled')->orderBy('created_at','desc')->get();
        $transferRequests = TransferRequest::where('user_id',$user->id)->orderBy('created_at','desc')->get();
        $prescriptionRefills = PrescriptionRefill::with(['prescription','user'])->where('user_id',$user->id)->where('status','!=','cancelled')->orderBy('created_at','desc')->get();
        $existingPrescriptions = PrescriptionOld::where('user_id',$user->id)->orderBy('created_at','desc')->get();
        $cprescriptions = Prescription::where('user_id',$user->id)->where('status','=','cancelled')->orderBy('created_at','desc')->get();
        
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
                'prescriptionRefills'=>$prescriptionRefills,
                'existingPrescriptions'=>$existingPrescriptions,
                'cprescriptions'=>$cprescriptions,
            ])
            ->withUser($user);
    }
    public function showEmployee(ManageUserRequest $request, User $user)
    {
        // print_r($user->id);
        // die;
        $auto_messages = AutoMessage::get()->pluck('message','id');
        $drugs = Drug::get()->pluck('brand_name','id');
        $province = Province::get()->pluck('name','slug');
        $prescriptions = Prescription::where('user_id',$user->id)->where('status','approved')->with(['medications'=> function ($query) {
            $query->where('status', '!=', 'cancelled');
        }])->has('medications')->where('status','!=','cancelled')->orderBy('created_at','desc')->get();
        $aaprescriptions = Prescription::where('user_id',$user->id)->where('status','!=','cancelled')->orderBy('created_at','desc')->get();
        $orders = Order::where('user_id',$user->id)->with(['prescription','order_items','order_items.medication','order_items.medication.prescription'])->has('order_items')->orderBy('created_at','desc')->get();
        $transferRequests = TransferRequest::where('user_id',$user->id)->orderBy('created_at','desc')->get();
        $prescriptionRefills = PrescriptionRefill::with(['prescription','user'])->where('status','!=','cancelled')->where('user_id',$user->id)->orderBy('created_at','desc')->get();
        $existingPrescriptions = PrescriptionOld::where('user_id',$user->id)->orderBy('created_at','desc')->get();
        //  print_r('<pre>');
        //  print_r($orders);
        //   die;
        $cprescriptions = Prescription::where('user_id',$user->id)->where('status','=','cancelled')->orderBy('created_at','desc')->get();

        return view('backend.auth.employee.show')
            ->with([
                'provinces'=>$province,
                'auto_messages'=>$auto_messages,
                'drugs'=>$drugs,
                'prescriptions'=>$prescriptions,
                'aaprescriptions'=>$aaprescriptions,
                'orders'=>$orders,
                'transferRequests'=>$transferRequests,
                'prescriptionRefills'=>$prescriptionRefills,
                'existingPrescriptions'=>$existingPrescriptions,
                'cprescriptions'=>$cprescriptions,
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
    

    public function editEmployee(ManageUserRequest $request, User $user, PermissionRepository $permissionRepository)
    {

        $province = Province::get()->pluck('name','name');
            
        return view('backend.auth.employee.edit')
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
    public function updateEmployee(UpdateUserRequest $request, User $user)
    {
        
        $user  = $this->userRepository->update($user, $request->except(['_token', '_method','files']),$request->has('avatar_location') ? $request->file('avatar_location') : false);
      //  ->route('admin.auth.user.show', $user)
        return redirect()->route('admin.auth.user.employee.show', $user)->withFlashSuccess(__('Employee Details Updates Successfully'));
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

    public function destroyEmployee(ManageUserRequest $request, User $user)
    {
        $this->userRepository->forceDelete($user,'employee');

        return redirect()->route('admin.auth.user.employee')->withFlashSuccess(__('Employee Deleted Successfully'));
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

    /**
     * @param \App\Http\Requests\Backend\Auth\User\ManageUserRequest $request
     * @param \App\Models\Auth\User $user
     *
     * @return mixed
     */
    public function members(ManageUserRequest $request, User $user)
    {
        return view('backend.auth.user.members')->withUser($user);
    }


    public function prescriptionRefillStatusUpdate(Request $request)
    {
       $data = $this->userRepository->prescriptionRefillStatusUpdate($request->except(['_token', '_method','files']));
        return $data;
    }

    public function prescriptionMedicationDeleted(Request $request)
    {
        $data = $this->userRepository->prescriptionMedicationDeleted($request->except(['_token', '_method']));
        return $data;
    }

    public function existingRefillStatusUpdate(Request $request)
    {
       $data = $this->userRepository->existingRefillStatusUpdate($request->except(['_token', '_method','files']));
        return $data;
    }



        
}
