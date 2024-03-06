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
            <label for="pronouns">Pronouns</label>
            <select id="pronouns" name="pronouns" class="form-control color-dark">
                <option value="">Select</option>
                <option value="She/Her" {{(isset($user->pronouns) && $user->pronouns == 'She/Her') ? 'selected' : ""}}>She/Her</option>
                <option value="He/Him" {{(isset($user->pronouns) && $user->pronouns == 'He/Him') ? 'selected' : ""}}>He/Him</option>
                <option value="They/Them" {{(isset($user->pronouns) && $user->pronouns == 'They/Them') ? 'selected' : ""}}>They/Them</option>
                <option value="Custom" {{(isset($user->pronouns) && $user->pronouns == 'Custom') ? 'selected' : ""}}>Custom</option>
            </select>
        </div>
        <div class="form-group custom-pronouns" {{ ($user->pronouns != 'Custom') ? 'style=display:none' : "" }} >
            <label for="custom-pronouns">Custom Pronouns</label>
            <input type="text" id="custom-pronouns" name="custom_pronouns" value="{{$user->custom_pronouns}}">
        </div>
          
          
          <div class="form-group">
            <label for="first_name" class="col-form-label">First Name:</label>
            <input type="text" name="first_name" class="form-control" value="{{$user->first_name}}" id="first_name">
          </div>
          <div class="form-group">
            <label for="last_name" class="col-form-label">Last Name:</label>
            <input type="text" name="last_name" class="form-control" value="{{$user->last_name}}" id="last_name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Sex Assigned At Birth:</label>
            
                
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
          <div class="form-group">
              <label for="lname">Gender Identity:</label>
              <div class="gender-div">
                  <span class="gender">
                      <input type="radio" name="gender_identity" {{ ( $auth->gender_identity == 'Male') ? 'checked' : ''}} value="Male">
                      <label>Male</label>
                  </span>
                  <span class="gender">
                      <input type="radio" name="gender_identity" {{ ( $auth->gender_identity == 'Female') ? 'checked' : ''}} value="Female">
                      <label>Female</label>
                  </span>
                  <span class="gender">
                      <input type="radio" name="gender_identity" {{ ( $auth->gender_identity == 'Non-Binary') ? 'checked' : ''}} value="Non-Binary">
                      <label>Non-Binary</label>
                  </span>
                  <span class="gender">
                      <input type="radio" name="gender_identity" {{ ( $auth->gender_identity == 'Trans') ? 'checked' : ''}} value="Trans">
                      <label>Trans</label>
                  </span>
                  <span class="gender">
                      <input type="radio" name="gender_identity" {{ ( $auth->gender_identity == 'Prefer Not To Share') ? 'checked' : ''}} value="Prefer Not To Share">
                      <label>Prefer Not To Share</label>
                  </span>
              </div>
          </div>

          <div class="form-group">
              <label for="self-described">Self Described:</label>
              <textarea class="form-control"  name="self_described" id="self-described" rows="2">{{$auth->self_described}}</textarea>
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
      $("#pronouns").change(function() {
            var pronouns = $(this).val();
            if(pronouns && pronouns == 'Custom'){
                $('.custom-pronouns').fadeIn();
            }else{
                $('.custom-pronouns').fadeOut();
            }
        });
     
    });
 

      </script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush