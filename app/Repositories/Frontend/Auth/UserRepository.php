<?php

namespace App\Repositories\Frontend\Auth;

use App\Events\Frontend\Auth\UserConfirmed;
use App\Events\Frontend\Auth\UserProviderRegistered;
use App\Exceptions\GeneralException;
use App\Models\Auth\Role;
use App\Models\Auth\SocialAccount;
use App\Models\Auth\User;
use App\Models\HealthCard;
use App\Models\HealthInformation;
use App\Models\Insurance;
use App\Models\Address;
use App\Models\PaymentMethod;
use App\Models\Drug;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TransferRequest;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use App\Repositories\BaseRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use File;
/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = User::class;

    /**
     * @param      $input
     * @param bool $expired
     *
     * @throws GeneralException
     * @return bool
     */
    public function updatePassword($input, $expired = false)
    {
        $user = $this->find(auth()->id());

        if (Hash::check($input['old_password'], $user->password)) {
            if ($expired) {
                $user->password_changed_at = now()->toDateTimeString();
            }

            return $user->update(['password' => $input['password']]);
        }

        throw new GeneralException(__('exceptions.frontend.auth.password.change_mismatch'));
    }

    /**
     * @param \App\Models\Auth\User;
     * @param array $input
     * @param bool|UploadedFile  $image
     *
     * @throws GeneralException
     * @return array|bool
     */
    public function update(User $user, array $input, $image = false)
    {
        
        if(isset($input['first_name'])){
            $user->first_name = $input['first_name'];
        }
        if(isset($input['last_name'])){
            $user->last_name = $input['last_name'];
        }
        // if(isset($input['avatar_type'])){
        //     $user->avatar_type = $input['avatar_type'];
        // }
        if(isset($input['date_of_birth'])){
            $user->date_of_birth = $input['date_of_birth'];
        }
        if(isset($input['gender'])){
            $user->gender = $input['gender'];
        }
        if(isset($input['is_profile_status'])){
            $user->is_profile_status = $input['is_profile_status'];
        }
        if(isset($input['profile_step'])){
            $user->profile_step = $input['profile_step'];
        }
        if(isset($input['email'])){
            $user->email = $input['email'];
        }
        if(isset($input['password'])){
            $user->password = $input['password'];
        }
        if(isset($input['province'])){
            $user->province = $input['province'];
        }
        if(isset($input['alternate_phone'])){
            $user->alternate_phone = $input['alternate_phone'];
        }


        // Upload profile image if necessary
        // if ($image) {
        //     $user->avatar_location = $image->store('/avatars', 'public');
        // } else {
        //     // No image being passed
        //     if(isset($input['avatar_type'])){


        //     if ($input['avatar_type'] === 'storage') {
        //         // If there is no existing image
        //         if (auth()->user()->avatar_location === '') {
        //             throw new GeneralException('You must supply a profile image.');
        //         }
        //     } else {
        //         // If there is a current image, and they are not using it anymore, get rid of it
        //         if (auth()->user()->avatar_location !== '') {
        //             Storage::disk('public')->delete(auth()->user()->avatar_location);
        //         }

        //         $user->avatar_location = null;
        //     }
        //     }else{
        //         $user->avatar_location = null;
        //     }
        // }

        if($image){
            $nuuid = Uuid::uuid4()->toString();
            $fileName   = $nuuid . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/frontend/avatar');
            $image->move($destinationPath, $fileName);
            $front_url = 'img/frontend/avatar/'.$fileName;
            $user->avatar_type = 'upload';
            $user->avatar_location = $front_url;
            
            // print_r( $front_url);
            // die;
            
        }

        if ($user->canChangeEmail()) {
            //Address is not current address so they need to reconfirm
            if ($user->email !== $input['email']) {
                //Emails have to be unique
                if ($this->getByColumn($input['email'], 'email')) {
                    throw new GeneralException(__('exceptions.frontend.auth.email_taken'));
                }

                // Force the user to re-verify his email address if config is set
                if (config('access.users.confirm_email')) {
                    $user->confirmation_code = md5(uniqid(mt_rand(), true));
                    $user->confirmed = false;
                    $user->notify(new UserNeedsConfirmation($user->confirmation_code));
                }
                $user->email = $input['email'];
                $updated = $user->save();

                // Send the new confirmation e-mail

                return [
                    'success' => $updated,
                    'email_changed' => true,
                ];
            }
        }
        if( $user->save()){
            if(isset($input['password_updated'])){

                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $user = User::where('id',$user->parent_id)->first(); 
                   
                }
                
                if($user->mobile_no && $user->dialing_code){
                    $mobile = $user->dialing_code.$user->mobile_no;
                    sendMessage($mobile,'mail','patient_account_completed',$data=null);
                        if(isset($user->email)){
                            sendMail('mail','patient_account_completed',$data=null,$user->id,'Patient Account');
                        }
                }
            }

        }

       return $user;
    }

    /**
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function create(array $data)
    {
        $user = $this->createUserStub($data);

        return DB::transaction(function () use ($user) {
            if ($user->save()) {
                //Attach new roles
                if ($roles = Role::where('name', config('access.users.default_role'))->get()->pluck('id')->toArray()) {
                    $user->attachRoles($roles);
                }
            }

            /*
             * If users have to confirm their email and this is not a social account,
             * and the account does not require admin approval
             * send the confirmation email
             *
             * If this is a social account they are confirmed through the social provider by default
             */
            if (config('access.users.confirm_email')) {
                // Pretty much only if account approval is off, confirm email is on, and this isn't a social account.
                $user->notify(new UserNeedsConfirmation($user->confirmation_code));
            }

            // Return the user object
            return $user;
        });
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createUserStub($input)
    {
        $user = self::MODEL;
        $user = new $user();
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);
        $user->confirmation_code = md5(uniqid(mt_rand(), true));
        $user->confirmed = ! (config('access.users.requires_approval') || config('access.users.confirm_email'));

        return $user;
    }

    /**
     * @param $code
     *
     * @throws GeneralException
     * @return bool
     */
    public function confirm($code)
    {
        $user = $this->findByConfirmationCode($code);

        if ($user->confirmed === true) {
            throw new GeneralException(__('exceptions.frontend.auth.confirmation.already_confirmed'));
        }

        if ($user->confirmation_code === $code) {
            $user->confirmed = true;

            event(new UserConfirmed($user));

            return $user->save();
        }

        throw new GeneralException(__('exceptions.frontend.auth.confirmation.mismatch'));
    }

    /**
     * @param $code
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findByConfirmationCode($code)
    {
        $user = $this->getByColumn($code, 'confirmation_code');

        $model_name = static::MODEL;

        if ($user instanceof $model_name) {
            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.not_found'));
    }

    /**
     * @param $token
     *
     * @return bool|\Illuminate\Database\Eloquent\Model
     */
    public function findByPasswordResetToken($token)
    {
        foreach (DB::table(config('auth.passwords.users.table'))->get() as $row) {
            if (password_verify($token, $row->token)) {
                return $this->getByColumn($row->email, 'email');
            }
        }

        return false;
    }

    /**
     * @param $uuid
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findByUuid($uuid)
    {
        $user = (new User)
            ->uuid($uuid)
            ->first();

        if ($user instanceof User) {
            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.not_found'));
    }

    /**
     * @param $data
     * @param $provider
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findOrCreateProvider($data, $provider)
    {
        // User email may not provided.
        $user_email = $data->email ?: "{$data->id}@{$provider}.com";

        // Check to see if there is a user with this email first.
        $user = $this->getByColumn($user_email, 'email');

        /*
         * If the user does not exist create them
         * The true flag indicate that it is a social account
         * Which triggers the script to use some default values in the create method
         */
        if (! $user) {
            // Registration is not enabled
            if (! config('access.registration')) {
                throw new GeneralException(__('exceptions.frontend.auth.registration_disabled'));
            }

            // Get users first name and last name from their full name
            $nameParts = $this->getNameParts($data->getName());

            $user = User::create([
                'first_name' => $nameParts['first_name'],
                'last_name' => $nameParts['last_name'],
                'email' => $user_email,
                'active' => true,
                'confirmed' => true,
                'password' => null,
                'avatar_type' => $provider,
            ]);

            if ($user) {
                // Add the default site role to the new user
                $user->assignRole(config('access.users.default_role'));
            }

            event(new UserProviderRegistered($user));
        }

        // See if the user has logged in with this social account before
        if (! $user->hasProvider($provider)) {
            // Gather the provider data for saving and associate it with the user
            $user->providers()->save(new SocialAccount([
                'provider' => $provider,
                'provider_id' => $data->id,
                'token' => $data->token,
                'avatar' => $data->avatar,
            ]));
        } else {
            // Update the users information, token and avatar can be updated.
            $user->providers()->update([
                'token' => $data->token,
                'avatar' => $data->avatar,
            ]);

            $user->avatar_type = $provider;
            $user->update();
        }

        // Return the user object
        return $user;
    }

    /**
     * @param $fullName
     *
     * @return array
     */
    protected function getNameParts($fullName)
    {
        $parts = array_values(array_filter(explode(' ', $fullName)));
        $size = count($parts);
        $result = [];

        if (empty($parts)) {
            $result['first_name'] = null;
            $result['last_name'] = null;
        }

        if (! empty($parts) && $size === 1) {
            $result['first_name'] = $parts[0];
            $result['last_name'] = null;
        }

        if (! empty($parts) && $size >= 2) {
            $result['first_name'] = $parts[0];
            $result['last_name'] = $parts[1];
        }

        return $result;
    }

    public function createHealthCard(array $data){
        
        $healthCard = new HealthCard;
        
        $front_img = (isset($data['front_img'])) ? $data['front_img'] : '' ;
        $back_img = (isset($data['back_img'])) ? $data['back_img'] : '' ;
        
        if(isset($data['health_id']) && !empty($data['health_id'])){
            $healthCard = HealthCard::find($data['health_id']);
            $healthcard_msg_key =   'healthcard_updated';
        }else{
            $healthCard = new HealthCard;
            $healthcard_msg_key =   'insurance_created';
        }
        
        $healthCard->user_id = auth()->user()->id;
        $healthCard->card_number = (isset($data['health_card_number'])) ? $data['health_card_number'] : '' ;
        if($front_img){
                $uuid = Uuid::uuid4()->toString();
                $fileName   = $uuid . '.' . $front_img->getClientOriginalExtension();
                $destinationPath = public_path('img/frontend/health-card');
                $front_img->move($destinationPath, $fileName);
                $front_url = 'img/frontend/health-card/'.$fileName;
                $healthCard->front_img = $front_url;
                
        } 
        if($back_img){
            $uuid = Uuid::uuid4()->toString();
            $fileName   = $uuid. '.' . $back_img->getClientOriginalExtension();
            $destinationPath = public_path('img/frontend/health-card');
            $back_img->move($destinationPath, $fileName);
            $back_url = 'img/frontend/health-card/'.$fileName;
            $healthCard->back_img = $back_url;
            
        }     
        $healthCard->odsp = null;
        $healthCard->trillium_program = null;
        $healthCard->ohip = null;
        if(isset($data['odsp']) && !empty($data['odsp'])){
            $healthCard->odsp = $data['odsp'];
        }
        if(isset($data['trillium_program']) && !empty($data['trillium_program'])){
            $healthCard->trillium_program = $data['trillium_program'];
        }
        if(isset($data['ohip']) && !empty($data['ohip'])){
            $healthCard->ohip = $data['ohip'];
        }
          //dd($healthCard);
            
            if($healthCard->save()){
                $user = auth()->user();

                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $parient_name = $user->full_name;
                    $user = User::where('id',$user->parent_id)->first(); 
                    $data1 =  "Health Card details updated by ".$user->full_name.' to '.$parient_name;
                }else{
                    $data1 =  "Health Card details updated by ".$user->full_name;
                    
                }


                // send messages to users
                $mobile = $user->dialing_code.$user->mobile_no;
               // sendMessage($mobile,'mail',$healthcard_msg_key,null);
                if(isset($user->email)){
                   // sendMail('mail',$healthcard_msg_key,null,$user->id,'Health Card');
                }

                //send messages to admin
                $admin = User::whereHas('roles', function ($subQuery) { 
                                $subQuery->where('name', 'Administrator');
                            })->first();
                $adminmobile = $admin->dialing_code.$admin->mobile_no;
                        //sendMessage($adminmobile,'admin',null,$data1);
                        if(isset($admin->email)){
                        //    sendMail('admin',null,$data1,$admin->id,'Health Card');
                        }
            }
            return $healthCard;
        
    }

    public function createInsurance(array $data){
        $userData = User::find(auth()->id());
        if(isset($data['is_insurance']) && $data['is_insurance'] == 1){
            
            $userData->is_insurance = 1;
            
        }else{
            $userData->is_insurance = 0;
        
            if(isset($data['front_img']) || isset($data['back_img'])){
                $front_img = (isset($data['front_img'])) ? $data['front_img'] : '' ;
                $back_img = (isset($data['back_img'])) ? $data['back_img'] : '' ;
        
                $this->insuranceImageUpload($front_img,$back_img,'primary');

            }

            if(isset($data['secondary_front_img']) || isset($data['secondary_back_img'])){
                $front_img = (isset($data['secondary_front_img'])) ? $data['secondary_front_img'] : '' ;
                $back_img = (isset($data['secondary_back_img'])) ? $data['secondary_back_img'] : '' ;
        
                $this->insuranceImageUpload($front_img,$back_img,'secondary');

            }

            if(isset($data['tertiary_front_img']) || isset($data['tertiary_back_img'])){
                $front_img = (isset($data['tertiary_front_img'])) ? $data['tertiary_front_img'] : '' ;
                $back_img = (isset($data['tertiary_back_img'])) ? $data['tertiary_back_img'] : '' ;
                
                $this->insuranceImageUpload($front_img,$back_img,'tertiary');

            }

            if(isset($data['quaternary_front_img']) || isset($data['quaternary_back_img'])){
                $front_img = (isset($data['quaternary_front_img'])) ? $data['quaternary_front_img'] : '' ;
                $back_img = (isset($data['quaternary_back_img'])) ? $data['quaternary_back_img'] : '' ;
                
                $this->insuranceImageUpload($front_img,$back_img,'quaternary');

            }
        }
        if($userData->save()){
           $user = auth()->user();
           if(isset($user->parent_id) && !empty($user->parent_id)){ 
                $parient_name = $user->full_name;
                $user = User::where('id',$user->parent_id)->first(); 
                $data1 =  "Insurance details updated by ".$user->full_name.' to '.$parient_name;
            }else{
                $data1 =  "Insurance details updated by ".$user->full_name;
                
            }


            // send messages to users
            $mobile = $user->dialing_code.$user->mobile_no;
            //sendMessage($mobile,'mail','insurance_created',null);
            if(isset($user->email)){
              //  sendMail('mail','insurance_created',null,$user->id,'Insurance');
            }

            //send messages to admin
            $admin = User::whereHas('roles', function ($subQuery) { 
                            $subQuery->where('name', 'Administrator');
                        })->first();
            $adminmobile = $admin->dialing_code.$admin->mobile_no;
           // sendMessage($adminmobile,'admin',null,$data1);
            if(isset($admin->email)){
              //  sendMail('admin',null,$data1,$admin->id,'Insurance');
            }
           
            return true;
        }
        return false;
        
    }
    public function insuranceImageUpload($front_img,$back_img,$insurance_type){
        $uuid = Uuid::uuid4()->toString();
        $insurance = new Insurance;
        $insurance->user_id = auth()->user()->id;
        if($front_img){
            
                $fileName   = $uuid . '.' . $front_img->getClientOriginalExtension();
                $destinationPath = public_path('img/frontend/insurance');
                $front_img->move($destinationPath, $fileName);
                $front_url = 'img/frontend/insurance/'.$fileName;
                $insurance->front_img = $front_url;
                
        } 
        if($back_img){
            
            $fileName   = $uuid . '.' . $back_img->getClientOriginalExtension();
            $destinationPath = public_path('img/frontend/insurance');
            $back_img->move($destinationPath, $fileName);
            $back_url = 'img/frontend/insurance/'.$fileName;
            $insurance->back_img = $back_url;
            
        }  
        $insurance->type = $insurance_type;   
            
        $insurance->save();
        

    }
    public function saveAddress(array $data){
        
        if(isset($data['id']) && Address::find($data['id'])){
            $address = Address::find($data['id']);

            if($address->address_type == 'Shipping Address'){
                $address->address_type = 'Shipping Address';
            }else{
                $address->address_type = 'Billing Address';
            }

        }else{
            $address = new Address;


            $billingAddress = new Address;
            $billingAddress->user_id = auth()->user()->id;
            $billingAddress->address1 = $data['billing_address1'];
            $billingAddress->address2 = $data['billing_address2'];
            $billingAddress->city = $data['billing_address_city'];
            $billingAddress->postal_code = $data['billiing_postal_code'];
            $billingAddress->province = $data['billing_province'];
            $billingAddress->address_type = 'Billing Address';
            $billingAddress->mark_as = 'undefault';
            $billingAddress->save();
            $address->address_type = 'Shipping Address';
        }
        $address->user_id = auth()->user()->id;
        $address->address1 = $data['address1'];
        $address->address2 = $data['address2'];
        $address->city = $data['city'];
        $address->postal_code = $data['postal_code'];
        $address->province = $data['province'];
        
        $address->mark_as = 'default';
       
               
        if($address->save()){
            $user = auth()->user();


           




            if(isset($user->parent_id) && !empty($user->parent_id)){ 
                $parient_name = $user->full_name;
                $user = User::where('id',$user->parent_id)->first(); 
                $data1 =  "Address details updated by ".$user->full_name.' to '.$parient_name;
            }else{
                $data1 =  "Address details updated by ".$user->full_name;
                
            }

             // send messages to users
             $mobile = $user->dialing_code.$user->mobile_no;
            // sendMessage($mobile,'mail','address_created',null);
             if(isset($user->email)){
                // sendMail('mail','address_created',null,$user->id,'Address');
             }
 
             //send messages to admin
             $admin = User::whereHas('roles', function ($subQuery) { 
                             $subQuery->where('name', 'Administrator');
                         })->first();
             $adminmobile = $admin->dialing_code.$admin->mobile_no;
             //sendMessage($adminmobile,'admin',null,$data1);
             if(isset($admin->email)){
                // sendMail('admin',null,$data1,$admin->id,'Address');
             }
        }
        return $address;
        
    }
    public function savePayment(array $data){
            $card = new PaymentMethod;
          $card->user_id = auth()->user()->id;
          $card->card_number = $data['card_number'];
          $card->expiry_date = $data['expiry_month'].'/'.$data['expiry_year'];
          $card->cvc = $data['cvc'];
          
        $uuid = Uuid::uuid4()->toString();
        $front_img = (isset($data['front_img'])) ? $data['front_img'] : '' ;
        $back_img = (isset($data['back_img'])) ? $data['back_img'] : '' ;
        if($front_img){

            $fileName   = $uuid . '.' . $front_img->getClientOriginalExtension();
            $destinationPath = public_path('img/frontend/payment-card');
            $front_img->move($destinationPath, $fileName);
            $front_url = 'img/frontend/payment-card/'.$fileName;
            $card->front_img = $front_url;

        } 
        if($back_img){
            
            $fileName   = $uuid. '.' . $back_img->getClientOriginalExtension();
            $destinationPath = public_path('img/frontend/payment-card');
            $back_img->move($destinationPath, $fileName);
            $back_url = 'img/frontend/payment-card/'.$fileName;
            $card->back_img = $back_url;
            
        }    
          
           
          if($card->save()){
            
            $user = auth()->user();

            if(isset($user->parent_id) && !empty($user->parent_id)){ 
                $parient_name = $user->full_name;
                $user = User::where('id',$user->parent_id)->first(); 
                $data1 =  "Payment Method updated by ".$user->full_name.' to '.$parient_name;
            }else{
                $data1 =  "Payment Method updated by ".$user->full_name;
                
            }

            // send messages to users
            $mobile = $user->dialing_code.$user->mobile_no;
           // sendMessage($mobile,'mail','payment_method_created',null);
            if(isset($user->email)){
              //  sendMail('mail','payment_method_created',null,$user->id,'Payment Method');
            }

            //send messages to admin
            $admin = User::whereHas('roles', function ($subQuery) {
                            $subQuery->where('name', 'Administrator');
                        })->first();
            $adminmobile = $admin->dialing_code.$admin->mobile_no;
           // sendMessage($adminmobile,'admin',null,$data1);
            if(isset($admin->email)){
              //  sendMail('admin',null,$data1,$admin->id,'Payment Method');
            }
        }
          return $card;
          
      }

      public function createHealthInformation(array $data){
        
        if(isset($data['health_information_id'])){
            $healthInformation = HealthInformation::find($data['health_information_id']);
        }else{
            $healthInformation = new HealthInformation;
        }
        
        $healthInformation->user_id = auth()->user()->id;
        $healthInformation->allergies = $data['allergie'];
        if($data['allergie'] == 1){
            $healthInformation->allergies_medications = $data['allergies_medications'];

        }else{
            $healthInformation->allergies_medications = null;

        }
        $healthInformation->supplements_medications = $data['supplement_medicaton'];
                
          
        if($healthInformation->save()){

            $user = auth()->user();
            
            if(isset($user->parent_id) && !empty($user->parent_id)){ 
                $parient_name = $user->full_name;
                $user = User::where('id',$user->parent_id)->first(); 
                $data1 =  "Health information updated by ".$user->full_name.' to '.$parient_name;
            }else{
                $data1 =  "Health information updated by ".$user->full_name;
                
            }


            // send messages to users
            $mobile = $user->dialing_code.$user->mobile_no;
           // sendMessage($mobile,'mail','healthinformation_created',null);
            if(isset($user->email)){
             //   sendMail('mail','healthinformation_created',null,$user->id,'Healthinformation');
            }

            //send messages to admin
            $admin = User::whereHas('roles', function ($subQuery) {
                            $subQuery->where('name', 'Administrator');
                        })->first();
            //$data1 =  "Health information updated by ".$user->full_name;
            $adminmobile = $admin->dialing_code.$admin->mobile_no;
          //  sendMessage($adminmobile,'admin',null,$data1);
            if(isset($admin->email)){
              //  sendMail('admin',null,$data1,$admin->id,'Healthinformation');
            }
        }
        return $healthInformation;
        
    }
    public function deleteAddress(array $data){
        
        $address = Address::find($data['id']);
        if($address->delete()){
            return true;
        }
        
    }

    public function addressDefaultChange(array $data){
        $addressdefaultIds = Address::where(['user_id'=> $data['user_id'],'mark_as'=>'default'])->update(['mark_as'=>'undefault']);
        $address = Address::find($data['id']);
        $address->mark_as = 'default';
        if($address->update()){
            //$address = Address::where('id',$data['id'])->update(['mark_as'=>'undefault']);
            return true;
        }
        
    }

    public function deletePayment(array $data){
        
        $address = PaymentMethod::find($data['id']);
        if($address->delete()){
            return true;
        }
        
    }
    public function paymentDefaultChange(array $data){
        $addressdefaultIds = PaymentMethod::where(['user_id'=> $data['user_id'],'default'=>'yes'])->update(['default'=>'no']);
        $address = PaymentMethod::find($data['id']);
        $address->default = 'yes';
        if($address->update()){
            return true;
        }
        
    }

    public function insuranceDelete(array $data){
         $insurance = Insurance::find($data['id']);
         if(File::exists($insurance->back_img)) {
            File::delete($insurance->back_img);
        }
        if(File::exists($insurance->front_img)) {
            File::delete($insurance->front_img);
        }
        if($insurance->forceDelete()){
            return true;
        }
        
    }

    public function healthCardDelete(array $data){
        $healthCard = HealthCard::find($data['id']);
        if(File::exists($healthCard->back_img) && $data['type'] == 'back_img') {
           File::delete($healthCard->back_img);
           $healthCard->back_img = null;

       }
       if(File::exists($healthCard->front_img) && $data['type'] == 'front_img') {
           File::delete($healthCard->front_img);
           $healthCard->front_img = null;
       }
       
       if($healthCard->update()){
           return true;
       }
       
   }

   public function placeAjaxSearch(array $array){
        $total          =   '';
        $limit          =   10;
        $no_of_pages    =   '';
        $page_no        =   '';
        $offset         =   '';
        $curl = curl_init();

        $search = (isset($array['search'])) ? $array['search'] : '' ;
        $key     = env('GOOGLE_API_KEY');
        
        if(!empty($array['lat']) && !empty($array['long'])){
            $lat    = $array['lat'];
            $long   = $array['long']; 
            
                     
            $query = 'key='.$key.'&location=&'.$lat . ',' . $long.'&radius=50000&query=pharmacy%20'.$search.'+in+Canada';
            //$apiUrl ='https://maps.googleapis.com/maps/api/place/textsearch/json?key='.$key.'&query=pharmacy%20'.$search;
        }else{
            $query = 'key='.$key.'&query=pharmacy%20'.$search.'+in+Canada';
           // $apiUrl='https://maps.googleapis.com/maps/api/place/textsearch/json?key='.$key.'&query=pharmacy%20'.$search;
        }
        //$query = 'input=110%20Ward&key='.$key.'&query=pharmacy%20'.$search.'+in+Canada';
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://maps.googleapis.com/maps/api/place/textsearch/json?'.$query,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = json_decode(curl_exec($curl));

        curl_close($curl);
        //echo $response;
      //dd($response);
        $html ='<ul class="ajax-ul" style="display:block;">';
        
        if($response->status == 'OK'){

            foreach($response->results as $result){
                $html .='<li class="ajax-li" data-placeid="'.$result->place_id.'"><span>'.$result->name.'</span><address>'.$result->formatted_address.'</addrdess></li>';
            }

        }else{
            $html .='<li class="drug-list-child">Data not found.</li>';
        }

        $html .= '</ul>';
       
        return array(
                    'success' => true,
                    'html'          =>  $html,  
                );       

   }

   public function drugAjaxSearch(array $array){
    $total          =   Drug::get()->count();
    $limit          =   10;
    $no_of_pages    =   $total/$limit;
    $page_no        =   ($array['page_no']) ? $array['page_no'] : 0;
    $offset         =   $page_no*$limit;
    if ($array['search']) {
        $search = $array['search'];
        $drug   = Drug::where('brand_name', 'like', '%' . $search . '%')
                    ->orWhere('generic_name', 'like', '%' . $search . '%')
                    ->orWhere('manufacturer', 'like', '%' . $search . '%')->skip($offset)->take($limit)->get();
    }else{

        $drug = '';
    }

    $html ='';
    if($drug){
        foreach($drug as $out){
            $html .='<li class="drug-list-child"><a href="'.route('frontend.drug.single',$out->slug).'">'.$out->brand_name.'('.$out->id.')</a></li>';
        }
    }else{
            $html .='<li class="drug-list-child">Data not found.</li>';
    } 
    return array(
                'total'         =>  $total,  
                'no_of_pages'   =>  $no_of_pages,  
                'page_no'       =>  $page_no,  
                'html'          =>  $html,  
            );       

    }

   
    public function createMedicationOrder(array $data)
    {
       
        return DB::transaction(function () use ($data) {
           // $data['medication'];
            $order = new Order;
            $order->order_number = Order::generateOrderNumber();
            $order->prescription_id = $data['prescription_id'];
            $order->user_id = access()->user()->id;
            $order->total_amount = getTotalAmount($data['medication_ids']);
            $order->created_by = access()->user()->id;
            if($order->save()){
                foreach($data['medication_ids'] as $key => $medication){
                    $order_item = new OrderItem;       
                    $order_item->order_id = $order->id;
                    $order_item->medication_id = $medication;
                    $order_item->price = getPrice($medication);
                    $order_item->save();
                }

                $user = User::where('id',$order->user_id)->first();

                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $data1 =  "Your Order no is ".$order->order_number.'. and Total amount is $'.$order->total_amount.' to '.$user->full_name;
                    $user = User::where('id',$user->parent_id)->first(); 
               }else{
                    $data1 =  "Your Order no is ".$order->order_number.'. and Total amount is $'.$order->total_amount;
                    
                }

                if($user->mobile_no && $user->dialing_code){
                    $mobile = $user->dialing_code.$user->mobile_no;
                   //$data1 =  "Your Order no is ".$order->order_number.'. and Total amount is $'.$order->total_amount;
                        sendMessage($mobile,'mail','patient_order_created',$data1);
                        if(isset($user->email)){
                            sendMail('mail','patient_order_created',$data1,$user->id,'Patient Order');
                        }
                }


                return 1;
            }
          
        throw new GeneralException(__('Problem With Create Medication.'));
       });
    }

    public function transferRequestSave(array $array){

       $curl = curl_init();

        $search = (isset($array['search'])) ? $array['search'] : '' ;
        $key     = env('GOOGLE_API_KEY');
        $query = 'place_id='.$array['place_id'].'&key='.$key;

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://maps.googleapis.com/maps/api/place/details/json?'.$query,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = json_decode(curl_exec($curl));
//dd($response);
        curl_close($curl);
      
        if($response->status == 'OK'){
            $transferRequest = new TransferRequest();
            $transferRequest->business_status = (isset($response->result->business_status)) ? $response->result->business_status : '';
            $transferRequest->formatted_address = (isset($response->result->formatted_address)) ? $response->result->formatted_address : '';
            $transferRequest->name = (isset($response->result->name)) ? $response->result->name : '';
            $transferRequest->place_id = $response->result->place_id;
            $transferRequest->user_id = access()->user()->id;
            $transferRequest->status = 'pending';
            $transferRequest->transfer_number = TransferRequest::generateTransferNumber();
            $transferRequest->formatted_phone_number = (isset($response->result->formatted_phone_number)) ? $response->result->formatted_phone_number : '' ;

            if($transferRequest->save()){
                $user = auth()->user();

                if(isset($user->parent_id) && !empty($user->parent_id)){ 
                    $parient_name = $user->full_name;
                    $user = User::where('id',$user->parent_id)->first(); 
                    $data1 =  "New transfer request generated by ".$user->full_name." to ".$parient_name;
                    
               }else{
                    $data1 =  "New transfer request generated by ".$user->full_name;
                    
                }
                $admin = User::whereHas('roles', function ($subQuery) { 
                                $subQuery->where('name', 'Administrator');
                            })->first();
                //$data1 =  "New transfer request generated by ".$user->full_name;
                $mobile = $admin->dialing_code.$admin->mobile_no;

                        if(sendMessage($mobile,'admin',null,$data1) && isset($admin->email)){
                            sendMail('admin',null,$data1,$admin->id,'Transfer Request');
                        }
                return $transferRequest;
            }
        }else{
            throw new GeneralException(__('Problem With Create Transfer Request.'));
        }
        //$response->status ;
        //dd($response->result);
    
   }

   public function addMemberSave(array $input){
        $user = new User();
        if(isset($input['first_name'])){
            $user->first_name = $input['first_name'];
        }
        if(isset($input['last_name'])){
            $user->last_name = $input['last_name'];
        }
        if(isset($input['month']) && isset($input['date']) && isset($input['year'])){
            $user->date_of_birth = $input['date'].'-'.$input['month'].'-'.$input['year'];
        }
        if(isset($input['gender'])){
            $user->gender = $input['gender'];
        }
        if(isset($input['email'])){
            $user->email = $input['email'];
        }
        if(isset($input['password'])){
            $user->password = $input['password'];
        }
        if(isset($input['email'])){
            $user->password = $input['email'];
        }
        if(isset($input['phone_no'])){
            $user->mobile_no = $input['phone_no'];
        }
        if(isset($input['relationship'])){
            if($input['relationship'] == 'Other' && isset($input['relationship_type']) ){
                $user->relationship_type = $input['relationship_type'];  
            }
            $user->relationship = $input['relationship'];
            
        }
        $user->parent_id = access()->user()->id;
        
        if($user->save()){
            $user->attachRole(3);
            return $user;

        }else{
            throw new GeneralException(__('Problem With Create new member.'));
        }
    

   }


}
