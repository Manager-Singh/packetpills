@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<link rel="stylesheet" href="{{asset('step/assets/css/after-login-style.css')}}">
<style>

</style>
@endpush
@section('content')
<div class="container mt-0 mb-5">
		    	<div class="row ">
            <div class="col-md-12 text-right">  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Edit profile</button>
</div>
				    <div class="col-md-6">
              <div class="p-detail">
                <p class="txt-b">First Name</p>
                <p class="bold-txt">{{$user->first_name}} </p>
                <p class="txt-b">Date of Birth</p>
                <p class="bold-txt">{{$user->date_of_birth}}</p>
                <p class="txt-b">Cell Phone (SMS enabled)</p>
                <p class="bold-txt">{{$user->mobile_no}}</p>
                <p class="txt-b">Alternate Phone Ext XXXXXXXXXXX</p>
              </div>
              <!-- <label for="fname">Language Preference</label>
                <select name="language" id="language">
                    <option value="">English (EN)</option>
                    <option value="">Français (FR)</option>
                    
                  </select> -->

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


  
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update personal details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  id="personal-form" action="{{route('frontend.auth.step.personal.update')}}" method="post" enctype='multipart/form-data'>
      @csrf
          <div class="form-group">
            <label for="first_name" class="col-form-label">First Name:</label>
            <input type="text" name="first_name" class="form-control" value="{{$user->first_name}}" id="first_name">
          </div>
          <div class="form-group">
            <label for="last_name" class="col-form-label">Last Name:</label>
            <input type="text" name="last_name" class="form-control" value="{{$user->last_name}}" id="last_name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Gender:</label>
            
                
                <div class="gender-div">
                    <span class="gender">
                        <input type="radio" name="gender" {{ ( $auth->gender == 'Male') ? 'checked' : ''}} value="Male" required>
                        <label>Male</label>
                    </span>
                    <span class="gender">
                        <input type="radio" name="gender" {{ ( $auth->gender == 'Female') ? 'checked' : ''}} value="Female" required>
                        <label>Female</label>
                    </span>
                    <span class="gender">
                        <input type="radio" name="gender" {{ ( $auth->gender == 'Prefer to not share') ? 'checked' : ''}} value="Prefer to not share" required>
                        <label>Prefer to not share</label>
                    </span>
                </div>
                    
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <label for="lname">Date Of Birth</label>
              <p class="info">You must be at least 14 year old.</p>
              <span class="dob">
                <input type="text" class="form-control orderUnits" name="month" value="{{$auth->dob('month')}}"  placeholder="MM" maxlength="2"  required />

                <input type="text" class="form-control orderUnits1" name="date"  value="{{$auth->dob('day')}}" placeholder="DD" maxlength="2"  required />

                <input type="text" class="form-control orderUnits2"  name="year"  value="{{$auth->dob('year')}}"  placeholder="YYYY" maxlength="4"  required />
              </span>
            </div>
          </div>




        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="document.getElementById('personal-form').submit()">Update</button>
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