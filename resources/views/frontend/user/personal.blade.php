@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mt-5 mb-5">
		    	<div class="row ">
				    <div class="col-md-6">
              <div class="p-detail">
              <p class="txt-b">First Name</p>
              <p class="bold-txt">{{$user->first_name}} </p>
              <p class="txt-b">Date of Birth</p>
              <p class="bold-txt">{{$user->date_of_birth}}</p>
              <p class="txt-b">Phone number</p>
              <p class="bold-txt">{{$user->mobile_no}}</p>
              </div>
              <label for="fname">Language Preference</label>
                <select name="language" id="language">
                    <option value="">English (EN)</option>
                    <option value="">Français (FR)</option>
                    
                  </select>

				    </div>
				    <div class="col-md-6">   
              <div class="p-detail">
              <p class="txt-b">Last Name</p>
              <p class="bold-txt">{{$user->last_name}}</p>
              <p class="txt-b">Gender</p>
              <p class="bold-txt">{{$user->gender}}</p>
              <p class="txt-b">Email Id</p>
              <p class="bold-txt">{{$user->email}}</p>
                 </div>
                </div>
 
			
			</div>
		</div>
@endsection

@push('after-scripts')
<script>
   
    $(document).ready(function(){       
       
     
    });
 

      </script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush