<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Http\Request;
use App\Models\Drug;
use App\Models\Prescription;
use App\Models\PrescriptionRefill;
use App\Models\MedicationItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Auth\User;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use App\Http\Responses\RedirectResponse;
use File;
use Ramsey\Uuid\Uuid;
/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (! auth()->user()->isAdmin()) {
            return redirect(route('frontend.user.dashboard'))->withFlashDanger('You are not authorized to view admin dashboard.');
        }
        if(isset($_GET['cyear'])){
            $cyear = $_GET['cyear'];
            // print_r($_GET['cyear']);
            // die;
        }else{
            $cyear = 'all';
        }
        $user['count']= User::whereHas('roles', function ($query) {
            $query->where('name', 'User');
        })->where('parent_id','=',null)->count();

        $prescription_refill['count'] = PrescriptionRefill::has('user')->count();
        $prescription['count'] = Prescription::has('user')->count();
        $order['count'] = Order::has('user')->count();
        
        return view('backend.dashboard')->with([
            'userDataset'=>$user,
            'prescriptionDataset'=>$prescription,
            'orderDataset'=>$order,
            'orderRevenueDataset'=>$this->getDataSets('App\Models\Order','revenue',$cyear),
            'transferRequestDataset'=>$this->getDataSets('App\Models\TransferRequest','count',$cyear),
            'prescriptionRefill'=>$prescription_refill,

        ]);
    }
    public function getDataSets($model,$type='count',$cyear)
    {   
        if($cyear=='current'){
            $currentYear = date('Y');
        }else{
            $currentYear = $cyear;
        }
        
        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        
       if($type=='revenue'){
        $QueryDFV = $model::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_amount) as total')
        )->groupBy('month');
        if($cyear=='all'){
            $count = $model::sum('total_amount');
        }else{
            $count = $model::whereYear('created_at', $currentYear)->sum('total_amount');
        }
        
            
       }else{
        $QueryDFV = $model::select(DB::raw("count(*) as total, date_format(created_at, '%m') as month"))->groupBy('month');
        if($cyear!='all'){    
        $usercounts = $model::whereRaw("YEAR(created_at) = $currentYear");
        }else{
            $usercounts = $model::query();
        }

            if ($model == 'App\Models\Auth\User') {
                $count = $usercounts->whereHas('roles', function($q) {
                    $q->where('name', 'User');
                })->count();
            } else {
                // For other models, simply count all records without filtering.
                $count = $usercounts->count();
            }
       }
        
        if($model=='App\Models\Auth\User'){
            $QueryDFV->whereHas('roles', function($q) {
                $q->where('name', 'User');
            });
        }
        if($cyear!='all'){
            $QueryDFV->whereRaw("YEAR(created_at) = $currentYear");
        }
        
        $result = $QueryDFV->get();
  

        
       
         $data = [];
        $months = [];
        foreach ($result as $rdata) {
            array_push($data,$rdata->total);
            array_push($months,$month[(int)$rdata->month - 1]);
        }
       
        // if($type=='revenue'){
        //     print_r( $data);
        //     print_r( $months);
        //     die;
        //             }
        return $dataset = [
            'data'=>implode(',',$data),
            'months'=>implode(',',$months),
            'count'=>$count
        ];
    }

    /**
     * This function is used to get permissions details by role.
     *
     * @param \Illuminate\Http\Request\Request $request
     */
    public function getPermissionByRole(Request $request)
    {
        if ($request->ajax()) {
            $role_id = $request->get('role_id');
            $rsRolePermissions = Role::where('id', $role_id)->first();
            $rolePermissions = $rsRolePermissions->permissions->pluck('display_name', 'id')->all();
            $permissions = Permission::pluck('display_name', 'id')->all();
            ksort($rolePermissions);
            ksort($permissions);
            $results['permissions'] = $permissions;
            $results['rolePermissions'] = $rolePermissions;
            $results['allPermissions'] = $rsRolePermissions->all;
            echo json_encode($results);
            exit;
        }
    }

    public function setting(Request $request){

        if ($request->isMethod('post')) {
            $dataCollection = collect($request->all())->except(['_token','id'])->toArray();
               // dd($request);
            if ($image = $request->file('logo_path')) {
                $uuid = Uuid::uuid4()->toString();
                $fileName   = $uuid . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img/frontend/logo');
                $image->move($destinationPath, $fileName);
                $dataCollection['logo_path'] = asset('img/frontend/logo/'.$fileName);
            }
            if($setting = Setting::first()){
                $setting = $setting->update($dataCollection);

            }else{
                $setting = Setting::updateOrCreate($dataCollection);
            }
            if($setting){
                
                return new RedirectResponse(route('admin.setting'), ['flash_success' => __('Information updated successfully.')]);

            }else{
                return new RedirectResponse(route('admin.setting'), ['flash_error' => __('Oops! Something went wrong. Please try again later.')]);
            }
            
        }

        $data['setting'] = $setting = Setting::first();
        return view('backend.setting.add',$data);

    }
}
