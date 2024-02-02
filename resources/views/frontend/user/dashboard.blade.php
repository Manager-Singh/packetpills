@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mb-5 mt-0 dashboard-main">
		    	<div class="row ">
              <div class="col-md-8">
                
              </div>  
              <div class="col-md-4 text-end">
                    <a href="{{route('frontend.auth.step.profile.completed')}}" class="next btn btn-primary info-btn mt-0">Go to service selection</a>
            
              </div> 
          </div>

          <p class="bold-txt mt-5">What would you like to do?</p>
          <div class="row med-iin">
            
            <div class="col-md-3">
            <a href="{{route('frontend.user.search.pharma')}}">
                <div class="med-info bg-light"> 
                    <p><i class="fi fi-br-nfc-pen"></i></p>                   
                    <p class="txt"><strong> Transfer Request </strong></p>
                    
                </div>
              </a>
            </div>  
            <div class="col-md-3">
            <a href="{{route('frontend.user.prescription.upload')}}">
              <div class="med-info bg-light">
                <p><i class="fi fi-br-file-prescription"></i></p> 
                <p class="txt"><strong> Have a new Prescription? </strong></p>
              </div>
            </a>
            </div> 
            <div class="col-md-3">
            <!-- <a href="{{route('frontend.drug.search')}}"> -->
              <div class="med-info bg-light">  
                <p><i class="fi fi-br-search-dollar"></i></p>                   
                  <p class="txt"><strong> Search prices <small>(Coming Soon)</small> </strong></p>
                  
              </div>
            <!-- </a> -->
            </div>
            <div class="col-md-3">
              <a href="{{route('frontend.user.prescription')}}">
                <div class="med-info bg-light">   
                  <p><i class="fi fi-br-arrows-repeat-1"></i></p>                  
                    <p class="txt"><strong> Request Refill </strong></p>
                  
                </div>
              </a>
            </div> 
        </div>
        <div class="row mt-5 appointemt-contact">
          <!-- <div class="col-md-6">
            <div class="bg-light">
                <div class="med-info">                    
                    <p class="txt"><strong>Add members to MisterPharmacist</strong></p>
 
              </div>  
          </div>
            </div> -->
            <!-- <div class="col-md-6">
              <div class="bg-light">
                <div class="med-info">                    
                    <p class="txt"><strong>Add members to MisterPharmacist</strong></p>
 
              </div>  
          </div>
            </div> -->
          </div>

          <!-- <p class="txt mt-5"><strong>OFFERS FOR YOU</strong></p>
          <div class="row bg-light">

                  <div class="med-info">                    
                      <p class="txt"><strong>Add members to MisterPharmacist</strong></p>
   

              </div>
       
            </div> -->

            <!-- <p class="txt mt-5"><strong>RECENT MEDICATIONS</strong></p>
          <div class="row">

              <div class="bg-light">
                  <div class="med-info">                    
                      <p class="txt"><strong>Add members to MisterPharmacist</strong></p>
                  </div>  

              </div>
       
            </div> -->
			
			</div>
@endsection

@push('after-scripts')
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush
