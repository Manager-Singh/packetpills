@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mb-5 mt-0 dashboard-main">
		    	<div class="row bg-light refill-section">
              <div class="col-md-8">
                <div class="med-info">                    
                    <p class="txt"><strong>Add members to MisterPharmacist</strong></p>
                    <p class="txt">Welcome latest design trends Designed </p>
                  
                </div> 
              </div>  
              <div class="col-md-4 text-end">
                    <a href="#" class="info-btn">Request Refill</a>
            
              </div> 
          </div>

          <p class="bold-txt mt-5">What would you like to do?</p>
          <div class="row med-iin">
            
            <div class="col-md-3">
            <a href="{{route('frontend.user.search.pharma')}}">
                <div class="med-info bg-light"> 
                    <p><i class="fa fa-exchange" aria-hidden="true"></i></p>                   
                    <p class="txt"><strong> Transfer your refills </strong></p>
                    
                </div>
              </a>
            </div>  
            <div class="col-md-3">
            <a href="{{route('frontend.user.prescription.upload')}}">
              <div class="med-info bg-light">
                <p><i class="fa fa-list" aria-hidden="true"></i></p> 
                <p class="txt"><strong> Have a new Prescription? </strong></p>
              </div>
            </a>
            </div> 
            <div class="col-md-3">
            <a href="{{route('frontend.drug.search')}}">
              <div class="med-info bg-light">  
                <p><i class="fa fa-search" aria-hidden="true"></i></p>                   
                  <p class="txt"><strong> Search prices </strong></p>
                  
              </div>
            </a>
            </div>
            <!-- <div class="col-md-3">
              <a href="#">
                <div class="med-info bg-light">   
                  <p><i class="fa fa-plus-square" aria-hidden="true"></i></p>                  
                    <p class="txt"><strong> Build your vitamin pack </strong></p>
                  
                </div>
              </a>
            </div> -->  
        </div>
        <div class="row mt-5 appointemt-contact">
          <div class="col-md-6">
            <div class="bg-light">
                <div class="med-info">                    
                    <p class="txt"><strong>Add members to MisterPharmacist</strong></p>
                    <p class="txt">Welcome latest design trends Designed </p>
 
              </div>  
          </div>
            </div>
            <div class="col-md-6">
              <div class="bg-light">
                <div class="med-info">                    
                    <p class="txt"><strong>Add members to MisterPharmacist</strong></p>
                    <p class="txt">Welcome latest design trends Designed </p>
 
              </div>  
          </div>
            </div>
          </div>

          <p class="txt mt-5"><strong>OFFERS FOR YOU</strong></p>
          <div class="row bg-light">

                  <div class="med-info">                    
                      <p class="txt"><strong>Add members to MisterPharmacist</strong></p>
                      <p class="txt">Welcome latest design trends Designed </p>
   

              </div>
       
            </div>

            <p class="txt mt-5"><strong>RECENT MEDICATIONS</strong></p>
          <div class="row">

              <div class="bg-light">
                  <div class="med-info">                    
                      <p class="txt"><strong>Add members to MisterPharmacist</strong></p>
                      <p class="txt">Welcome latest design trends Designed </p>
                  </div>  

              </div>
       
            </div>
			
			</div>
@endsection

@push('after-scripts')
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush
