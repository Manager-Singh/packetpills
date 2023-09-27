<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Http\Requests\Backend\Auth\User\StoreUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserRequest;
use App\Http\Responses\ViewResponse;
use App\Models\Auth\User;
use App\Models\Province;
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
        $this->userRepository->create($request->except(['_token', '_method','files']),$request->file('files'));

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.access.users.created'));
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
       $this->userRepository->paymentmethod($request->except(['_token', '_method']));

        return redirect()->back()->with('tab','paymentmethod')->withFlashSuccess(__('Payment Method Successfully Created.'));
    }
    public function edit_paymentmethod(Request $request)
    {
       $this->userRepository->edit_paymentmethod($request->except(['_token', '_method']));

        return redirect()->back()->with('tab','paymentmethod')->withFlashSuccess(__('Payment Method Successfully Updated.'));
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
        // dd($user);
        $province = Province::get()->pluck('name','name');
        return view('backend.auth.user.show')
            ->with([
                'provinces'=>$province,
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
        $this->userRepository->update($user, $request->all());

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.access.users.updated'));
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
}
