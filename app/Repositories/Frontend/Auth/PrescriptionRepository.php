<?php

namespace App\Repositories\Frontend\Auth;

use App\Events\Frontend\Auth\UserConfirmed;
use App\Events\Frontend\Auth\UserProviderRegistered;
use App\Exceptions\GeneralException;
use App\Models\Auth\Role;
use App\Models\Auth\SocialAccount;
use App\Models\Auth\User;
use App\Models\PrescriptionIteam;
use App\Models\Prescription;
use App\Models\PreciptionType;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use App\Repositories\BaseRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use App\Models\PrescriptionOld;

/**
 * Class PrescriptionRepository.
 */
class PrescriptionRepository extends BaseRepository
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
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->avatar_type = $input['avatar_type'];
        $user->date_of_birth = $input['date_of_birth'];
        $user->gender = $input['gender'];
        $user->is_profile_status ='completed';

        // Upload profile image if necessary
        if ($image) {
            $user->avatar_location = $image->store('/avatars', 'public');
        } else {
            // No image being passed
            if ($input['avatar_type'] === 'storage') {
                // If there is no existing image
                if (auth()->user()->avatar_location === '') {
                    throw new GeneralException('You must supply a profile image.');
                }
            } else {
                // If there is a current image, and they are not using it anymore, get rid of it
                if (auth()->user()->avatar_location !== '') {
                    Storage::disk('public')->delete(auth()->user()->avatar_location);
                }

                $user->avatar_location = null;
            }
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

        return $user->save();
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
            $user = Auth::user();
            $images = $data['prescription_upload'];
            $prescription = new Prescription;
            $prescription->prescription_number =  Prescription::generatePrescriptionNumber();
            $prescription->prescription_type_id = PreciptionType::first()->id;
            $prescription->user_id = $user->id;
            
            if($images && $prescription->save()){
                foreach($images as $key => $image){
                    $uuid = Uuid::uuid4()->toString();
                    $image  = $image; 
                    $fileName   = $uuid . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('img/frontend/prescription');
                    $image->move($destinationPath, $fileName);
                    $url = 'img/frontend/prescription/'.$fileName;  

                    $prescription_iteams = new PrescriptionIteam;
                    $prescription_iteams->page_no = $key +1;
                    $prescription_iteams->prescripiton_id = $prescription->id;
                    $prescription_iteams->prescription_upload = $url;
                    $prescription_iteams->save();
                }

                   
                    if(isset($user->parent_id) && !empty($user->parent_id)){ 
                        $data =  "Your Prescription no is ".$prescription->prescription_number.' to '.$user->full_name;
                        $user = User::where('id',$user->parent_id)->first(); 
                   }else{
                        $data =  "Your Prescription no is ".$prescription->prescription_number;
                        
                    }
                    
                if(isset($user->email)){
                    sendMail('mail','patient_prescription_created',$data,$user->id,'Prescription Created');
                }

                if($user->mobile_no && $user->dialing_code){
                    $mobile = $user->dialing_code.$user->mobile_no;
                    
                    
                    // if(sendMessage($mobile,'mail','patient_prescription_created',$data) && isset($user->email)){
                    //     sendMail('mail','patient_prescription_created',$data,$user->id,'Prescription Created');
                    // }
                }
               

                return $prescription_iteams;

            }

              

        
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



    public function oldPrescriptionCreate(array $data)
    {
            $user = Auth::user();
            $count = 0;
            $images = isset($data['prescription_img']) ? $data['prescription_img'] : null ;
            $prescription_numbers = $data['prescription_number'];
            $medication_names = $data['medication_name'];
            $existing_data = [];
            $existing_data['template'] = 'email-table';
            if(isset($prescription_numbers) && !empty($prescription_numbers)){
                foreach($prescription_numbers as $j=>$prescription_number){
                    $prescriptionOld = new PrescriptionOld;
                    $prescriptionOld->prescription_number =  $prescription_number;
                    $prescriptionOld->medication_name =  $medication_names[$j];
                    $prescriptionOld->user_id = $user->id;

                    $existing_data['data'][] =['rx'=>$prescription_number,'medicine'=>$medication_names[$j]];
                    if(isset($images) && !empty($images)){
                       
                            $uuid = Uuid::uuid4()->toString();
                            $image  = isset($images[$j]) && !empty($images[$j]) ? $images[$j] : null; 
                            if($image){
                                $fileName   = $uuid . '.' . $image->getClientOriginalExtension();
                                $destinationPath = public_path('img/frontend/prescription-old');
                                $image->move($destinationPath, $fileName);
                                $url = 'img/frontend/prescription-old/'.$fileName;  
                                $prescriptionOld->image =  $url;
                            }else{
                                $prescriptionOld->image =  null;
                            }
                            
                        }
                    $prescriptionOld->save();
                    $count++;
                }

                if($count == count($prescription_numbers)){
                    
                    $data1 =  "Existing prescription added by ".$user->full_name;
                    //send messages to admin
                    $admin = User::whereHas('roles', function ($subQuery) { 
                        $subQuery->where('name', 'Administrator');
                    })->first();
                    $adminmobile = $admin->dialing_code.$admin->mobile_no;
                        //sendMessage($adminmobile,'admin',null,$data1);    
                        if(isset($admin->email)){
                            sendMail('admin',null,$data1,$admin->id,'Existing Prescription Details',null,$existing_data);
                        }
                            return 1;
                }

           
            }else{
                return 0;
            }

            
           
            


              

        
    }
}
