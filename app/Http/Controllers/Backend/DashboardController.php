<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Http\Request;
use App\Models\Drug;
use App\Models\Prescription;
use App\Models\PrescriptionRefill;
use App\Models\PrescriptionOld;
use App\Models\MedicationItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Auth\User;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use App\Models\UserReferal;
use App\Http\Responses\RedirectResponse;
use File;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\View;
use App\Exports\ReferralExport;
use Maatwebsite\Excel\Facades\Excel;
/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        View::share('js', ['referrals']);
    }
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
        $existing_prescription_refill['count'] = PrescriptionOld::has('user')->count();
        $prescription['count'] = Prescription::has('user')->count();
        $order['count'] = Order::has('user')->count();
        $totlanewreferrs['count'] = UserReferal::where('status','new')->count();

        
        
        return view('backend.dashboard')->with([
            'userDataset'=>$user,
            'prescriptionDataset'=>$prescription,
            'orderDataset'=>$order,
            'orderRevenueDataset'=>$this->getDataSets('App\Models\Order','revenue',$cyear),
            'transferRequestDataset'=>$this->getDataSets('App\Models\TransferRequest','count',$cyear),
            'prescriptionRefill'=>$prescription_refill,
            'existingPrescriptionRefill'=>$existing_prescription_refill,
            'totlanewreferrs'=>$totlanewreferrs,

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
    public function referrals(Request $request){


        $data['user_referal'] = UserReferal::get();
        return view('backend.referal.list',$data);

    }
    public function getReferrals(Request $request){

        $query = UserReferal::query()
        ->with(['user']);
    
        $mquery = $query->orderBy('created_at', 'desc');
        return Datatables::of($mquery)
        ->escapeColumns(['id'])
        ->addColumn('name', function ($UserReferal) {
            return $UserReferal->user->first_name.' '.$UserReferal->user->last_name;
        })
        ->addColumn('source', function ($UserReferal) {
            return $UserReferal->from_you_found;
        })
        ->addColumn('details', function ($UserReferal) {
            if($UserReferal->from_you_found=='refer-by-user'){
                $data = '<div class="reffer-detail">';
                $data .= '<p><strong>Refrred By: '.$UserReferal->refred_by.'</strong></p>';
                $data .= '<p><strong>Name: </strong>'.$UserReferal->name.'</p>';
                $data .= '<p><strong>Email: </strong>'.$UserReferal->email.'</p>';
                $data .= '<p><strong>Contact Number: </strong>'.$UserReferal->contact_number.'</p>';
                $data .= '</div>';

                return $data;
            }
            if($UserReferal->from_you_found=='other'){
                return  '<p>'.$UserReferal->other_message.'</p>';
            }
            return '<p>I hear on <strong>'.$UserReferal->from_you_found.'</strong></p>';
        })
        ->addColumn('status', function ($UserReferal) {
            if($UserReferal->status=='new'){
                return ' <span class="badge badge-success">'.ucfirst($UserReferal->status).'</span>';
            }
            return ' <span class="badge badge-info">'.ucfirst($UserReferal->status).'</span>';
        })
        ->addColumn('created_at', function ($UserReferal) {
            return $UserReferal->created_at->toDateString();
        })
        ->make(true);

    }
    public function export($type = 'new')
    {
        return DB::transaction(function () use ($type) {
            $fileName = $type === 'all' ? 'all_referrals.csv' : 'new_referrals.csv';
    
            // Generate CSV export
            $export = Excel::download(new ReferralExport($type), $fileName);
    
            // If exporting only 'new' referrals, update their status to 'old'
            UserReferal::where('status', 'new')->update(['status' => 'old']);
    
            return $export;
        });
    }
    
}
