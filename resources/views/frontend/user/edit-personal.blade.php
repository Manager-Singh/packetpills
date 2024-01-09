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

        <div class="col-md-8 offset-md-2">
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
          <div class="form-group">
            <label for="alternate_phone" class="col-form-label">Alternate Phone:</label>
            <input type="text" id ="alternate_phone" name="alternate_phone" class="form-control" value="{{$user->alternate_phone}}" >
          </div>
          </div>



          <button type="button" class="next button" onclick="document.getElementById('personal-form').submit()">Update</button>


        </form>


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