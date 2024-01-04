<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Http\Request;
use App\Models\Drug;
use App\Models\Prescription;
use App\Models\MedicationItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Auth\User;
use Illuminate\Support\Facades\DB;

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
        return view('backend.dashboard')->with([
            'userDataset'=>$this->getDataSets('App\Models\Auth\User','count',$cyear),
            'prescriptionDataset'=>$this->getDataSets('App\Models\Prescription','count',$cyear),
            'orderDataset'=>$this->getDataSets('App\Models\Order','count',$cyear),
            'orderRevenueDataset'=>$this->getDataSets('App\Models\Order','revenue',$cyear),
            'transferRequestDataset'=>$this->getDataSets('App\Models\TransferRequest','count',$cyear),

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
}
