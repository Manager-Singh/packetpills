<?php
namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Auth\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\HealthInformation;
use App\Models\PaymentMethod;
use App\Models\Province;
use App\Models\Insurance;
use App\Models\HealthCard;
use App\Models\Drug;
use App\Models\Prescription;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{

    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        
        $this->userRepository = $userRepository;
        

        // $this->middleware(function ($request, $next) {
           
        //     if(Auth::check() && Auth::user()->is_profile_status == "completed"){
        //         return redirect()->route('frontend.user.dashboard');
        //     }else{
        //         return $next($request);
        //     }
            
        // });
        

    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //return '<h2>You are logedin successfully!</h2>';
        return view('frontend.user.dashboard'); 
    }

    public function serviceSelection(){
        //return '<h2>You are logedin successfully!</h2>';
        if(Auth::check() && Auth::user()->is_profile_status == "completed"){
            return redirect()->route('frontend.user.dashboard');
        }
        return view('frontend.auth.steps.service-selection');
    }

    public function stepTransfer(){
        return view('frontend.auth.steps.transfer');
    }
    public function prescription(){
        return view('frontend.auth.steps.prescription');
    }
    public function telehealth(){
        if(Auth::check() && Auth::user()->is_profile_status == "completed"){
            return redirect()->route('frontend.user.dashboard');
        }
        return view('frontend.auth.steps.telehealth');
    }
    public function personal(){
        if(Auth::check() && Auth::user()->is_profile_status == "completed"){
            return redirect()->route('frontend.user.dashboard');
        }
        
        return view('frontend.auth.steps.personal');
    }


    public function personal_save(Request $request){



        $output = $this->userRepository->update(
            Auth::user(),
            ['first_name'=>$request->first_name, 'last_name'=>$request->first_name, 'date_of_birth'=>$request->date.'-'.$request->month.'-'.$request->year,'profile_step'=>1],
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        if($output){
            return redirect()->route('frontend.auth.step.almostdone')->withFlashSuccess(__('Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }

    }
    public function almostdone(){
        if(Auth::check() && Auth::user()->is_profile_status == "completed"){
            return redirect()->route('frontend.user.dashboard');
        }
        return view('frontend.auth.steps.almostdone');
    }
    public function almostdone_save(Request $request){


        // 'province'=>$request->province,
        $output = $this->userRepository->update(
            Auth::user(),
            ['gender'=>$request->gender, 'email'=>$request->email, 'province'=>$request->province,'profile_step'=>2],
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        if($output){
            return redirect()->route('frontend.auth.step.create.password')->withFlashSuccess(__('Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }

    }
    public function createPassword(){
        if(Auth::check() && Auth::user()->is_profile_status == "completed"){
            return redirect()->route('frontend.user.dashboard');
        }
        return view('frontend.auth.steps.create-password');
    } 

    public function createPassword_save(Request $request){

        //dd($request->all());
        // 'province'=>$request->province,
        $output = $this->userRepository->update(
            Auth::user(),
            ['password'=>$request->password,'password_updated'=>$request->password_updated,'profile_step'=>3,'is_profile_status' =>'completed'],
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        if($output){
            return redirect()->route('frontend.auth.step.profile.completed')->withFlashSuccess(__('Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }

    }


    public function profileCompleted(){
        return view('frontend.auth.steps.profile-completed');
    }


    public function userPrescripiton()
    {
        $user = Auth::user();
       $data['prescriptions'] = Prescription::where('user_id',$user->id)->get();
        return view('frontend.user.prescription',$data); 
    }

    public function medications()
    {
         return view('frontend.user.medication'); 
    }
    public function orders()
    {
         return view('frontend.user.order'); 
    }
    public function healthCard()
    {
        $user = Auth::user();
        $data['healthCard']= HealthCard::where('user_id',$user->id)->first();
        //dd($data['healthCard']);
        return view('frontend.user.health-card',$data); 
    }
    public function healthInformation()
    {
        $user = Auth::user();
        $data['health_info']= HealthInformation::where('user_id',$user->id)->first();
        return view('frontend.user.health-information',$data); 
    }
    public function healthInformationsave(Request $request){
        
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->createHealthInformation($data);
        if($output){
            return redirect()->back()->withFlashSuccess(__('Health Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        
    }
    public function healthCardsave(Request $request){
        

        $data = collect($request->all())->toArray();
        $output = $this->userRepository->createHealthCard($data);
        if($output){
            return redirect()->back()->withFlashSuccess(__('HealthCard Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        
    }
    public function insurance(){
        $user = Auth::user();
        $data['primary_insurance']= Insurance::where('type','primary')->where('user_id',$user->id)->first();
        $data['secondary_insurance']= Insurance::where('type','secondary')->where('user_id',$user->id)->first();
        $data['tertiary_insurance']= Insurance::where('type','tertiary')->where('user_id',$user->id)->first();
        $data['quaternary_insurance']= Insurance::where('type','quaternary')->where('user_id',$user->id)->first();
        return view('frontend.user.insurance',$data); 
    }
    public function insuranceSave(Request $request){
        

        $data = collect($request->all())->toArray();
        $output = $this->userRepository->createInsurance($data);
        if($output){
            return redirect()->back()->withFlashSuccess(__('Insurance Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        
    }
    public function address(){
        $user = Auth::user();
        $data['address']= Address::where('user_id',$user->id)->get();
       
        $data['user'] = $user;
        return view('frontend.user.address-view',$data); 
    }
    public function addressAdd(){
        $data=[];
        $data['user'] = Auth::user();
        if(isset($_GET['id'])){
            
            $data['address']= Address::find($_GET['id']);
        }
        $data['provinces']= Province::get();
        return view('frontend.user.address',$data); 
    }
    public function addressSave(Request $request){
        
        if(!isset($request->id) && Address::where('address_type',$request->address_type)->exists()){
            return redirect()->back()->withFlashSuccess(__('Address type already exist.'));
        }

        $data = collect($request->all())->toArray();
        $output = $this->userRepository->saveAddress($data);


        if($output){
            return redirect()->route('frontend.user.address')->withFlashSuccess(__('Address Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        
    }
    public function payment(){
        $user = Auth::user();
        $data['payments']= PaymentMethod::where('user_id',$user->id)->get();
        $data['user'] = $user;
        return view('frontend.user.payment-view',$data); 
    }
    public function paymentAdd(){
        
        return view('frontend.user.payment'); 
    }
    public function paymentSave(Request $request){
        
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->savePayment($data);
        if($output){
            return redirect()->route('frontend.user.payment')->withFlashSuccess(__('Payment Information Updated'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }
        
    }
    public function personalDetails(){
        $data['user'] = Auth::user();
        return view('frontend.user.personal',$data); 
    }
    public function addressDelete(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->deleteAddress($data);
        if($output){
            $success = true;
        }else{
            $success = false;
        }

        return array('success'=>$success,'message'=>'');
        
    }
    public function addressDefaultChange(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->addressDefaultChange($data);
        if($output){
            $success = true;
        }else{
            $success = false;
        }
        return array('success'=>$success,'message'=>'');
        
    }
    public function paymentDefaultChange(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->paymentDefaultChange($data);
        if($output){
            $success = true;
        }else{
            $success = false;
        }
        return array('success'=>$success,'message'=>'');
        
    }
    public function paymentDelete(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->deletePayment($data);
        if($output){
            $success = true;
        }else{
            $success = false;
        }

        return array('success'=>$success,'message'=>'');
        
    }

    public function insuranceDelete(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->insuranceDelete($data);
        if($output){
            $success = true;
        }else{
            $success = false;
        }

        return array('success'=>$success,'message'=>'');
        
    }

    public function healthCardDelete(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->healthCardDelete($data);
        if($output){
            $success = true;
        }else{
            $success = false;
        }

        return array('success'=>$success,'message'=>'');
        
    }


    public function drugSearch()
    {
        $data['alldrugs'] = Drug::paginate(10); 
        
       return view('frontend.user.medications.search-medication',$data); 
    }

    public function drugSingleDetails(Request $request,$slug)
    {
        
        $data['drug'] = Drug::where('slug',$slug)->first(); 
        return view('frontend.user.medications.single-medication',$data); 
    }

    public function drugAjaxSearch(Request $request){
        $data = collect($request->all())->toArray();
        $output = $this->userRepository->drugAjaxSearch($data);
      
        return $output;
        
    }
    
}
