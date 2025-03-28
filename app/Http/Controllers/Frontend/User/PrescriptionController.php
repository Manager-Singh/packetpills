<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\SavePrescriptionRequest;
use App\Repositories\Frontend\Auth\PrescriptionRepository;

/**
 * Class PrescriptionController.
 */
class PrescriptionController extends Controller
{
    /**
     * @var PrescriptionRepository
     */
    protected $prescriptionRepository;

    /**
     * PrescriptionController constructor.
     *
     * @param PrescriptionRepository $userRepository
     */
    public function __construct(PrescriptionRepository $prescriptionRepository)
    {
        $this->prescriptionRepository = $prescriptionRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function prescriptionUpload()
    {
        
        // return '<h2>You are logedin successfully!</h2>';
        return view('frontend.user.prescription.tabs.upload-prescription');
    }

    /**
     * @param SavePrescriptionProfileRequest $request
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function save(SavePrescriptionRequest $request)
    {
        $data = collect($request->all())->toArray();
        $images = $data['prescription_upload'];
        
        if($images){
            foreach($images as $key => $image){
                $allowedExtensions = ['jpg', 'jpeg', 'png' ,'pdf']; // List of allowed file extensions
                $extension = strtolower($image->getClientOriginalExtension());
                if (!in_array($extension, $allowedExtensions)) {
                    // Return an error if the extension is not allowed
                    return redirect()->back()->withFlashInfo(__( 'Invalid file extension. Allowed extensions are: jpg, jpeg, png.'));
                }

            }

        }

        
        $output = $this->prescriptionRepository->create($data); 
        
        // E-mail address was updated, user has to reconfirm
       
        if($output){
            return redirect()->route('frontend.user.prescription')->withFlashSuccess(__('Thank you for uploading your prescription(s)! <br>Expect a follow up from a pharmacy team member soon!'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }

        
    }

    public function old_save(SavePrescriptionRequest $request)
    {
        $data = collect($request->all())->toArray();
        
        $output = $this->prescriptionRepository->oldPrescriptionCreate($data); 
        
        // E-mail address was updated, user has to reconfirm
       
        if($output){
            return redirect()->back()->withFlashSuccess(__('Thank you for uploading your existing prescription(s)! <br>Expect a follow up from a pharmacy team member soon!'));
        }else{
            return redirect()->back()->withFlashInfo(__('Something went wrong'));
        }

        
    }
}
