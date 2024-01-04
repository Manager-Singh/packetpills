@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mt-5 mb-5 pt-5">
		    	<div class="row ">
				    <div class="col-md-6">
              <div class="user-info">
                <img class="user-img" src="{{asset('step/assets/images/user.png')}}">
                <!-- <p class="bold-txt">Designed with the latest design trends</p> -->
              </div> 

				    </div>
				    <div class="col-md-6">

                            <div class="row">
                              <div class="col-md-12 company-card">
                                <img class="company-logo" src="{{asset('step/assets/images/logo-main.png')}}">
                                <p class="bold-txt">MisterPharmacist</p>
                                <p class="txt">Fax : 1-000-000-0000</p>
                                <a href="#" class="button save">Save contact details</a>
                              </div>
                            </div>
                            <a href="{{route('frontend.auth.step.personal')}}" class="next button">Secure your account</a>
                  
                 
                 
                </div>
 
			
			</div>
		</div>
@endsection

@push('after-scripts')
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush