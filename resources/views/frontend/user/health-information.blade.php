@extends('frontend.layouts.step')
@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<link rel="stylesheet" href="{{asset('step/assets/css/after-login-style.css')}}">
<style>
.bootstrap-tagsinput span {
    display: inherit;
    background-color: #8ac03d;
}
.bootstrap-tagsinput{
  width: 100%;
  height: 120px;
}
.bootstrap-tagsinput input {
    border: unset !important;
    width: 169px;
}
.radio1 {
    display: flex;
    padding: 14px 4px;
}
.radio1 input, .radio1 select {
    width: 64px;
    height: 32px;
}
.radio1 label {
    margin: 0px 0px 0;
    font-size: 17px;
    font-weight: 600;
    color: #212843;
}
.radio1 input[type='radio']:checked:after {
    width: 38px;
    height: 38px;
    border-radius: 21px;
    top: -3px;
    left: 11px;
    position: relative;
    background-color: #8ac03d;
    content: '';
    display: inline-block;
    visibility: visible;
    border: 2px solid white;
}
</style>
@endpush
@section('content')
<div class="container mt-0 mb-5 pt-0">
		    	<div class="row ">
				    <div class="col-md-12">
              <div class="user-info p-details">
                <i class="fi fi-br-file-medical-alt fa"></i>
                <p class="txt-large">Health information</p>
              </div> 

				    </div>
            <div class="col-md-2">

              </div>
				    <div class="col-md-8">

                        <form name="myForm" id="health-information" method='post' action="{{route('frontend.user.health.information.save')}}" enctype='multipart/form-data'>
                     @csrf
                            <label for="lname">Do you have allergies to any medications?</label>
                            <div class="radio1">
                                <input type="radio" data-parsley-multiple required id="yes" name="allergie" value="1" {{ ($health_info && $health_info->allergies == 1) ? 'checked' : '' }}/>
                                <label for="yes">Yes</label>
                            
                           
                                <input type="radio" data-parsley-multiple required id="no" name="allergie" value="0" {{ ($health_info && $health_info->allergies == 0) ? 'checked' : '' }}/>
                                <label for="no">No</label> 
                           
                            </div>
                            <div class="form-group allergies_medications" {{ ($health_info && $health_info->allergies == 1) ? 'style=display:block' : 'style=display:none' }} >

                            <label for="lname">Allergies to any medication list here</label>
                            <input id="allergies_medications" name="allergies_medications" rows="6" cols="100" data-role="tagsinput" value="{{ ($health_info) ? $health_info->allergies_medications : '' }}" placeholder="(e.g. Drug A, etc)">
                            

                            </div>
                            <div class="form-group">

                            <label for="lname">Enter any over the counter supplements and medications that you are taking</label>
                            <input id="w3review" required name="supplement_medicaton" rows="6" cols="100" data-role="tagsinput" placeholder="(e.g. Vitamin A, etc)" value="{{ ($health_info) ? $health_info->supplements_medications : '' }}" required />
                            

                            </div>
                            @if($health_info)
                            <input type="hidden" name="health_information_id" value="{{$health_info->id}}" />
                            <button type="submit" id="submit" class="next button submit" onclick="" >Update</button>
                            @else
                            <button type="submit" id="submit" class="next button submit" onclick="" >Save</button>
                            @endif
                            
                            
                                
                          </form>
                 
                 
                </div>
                <div class="col-md-2">
                </div>
			
			</div>
		</div>
@endsection

@push('after-scripts')
<script>
   
    $(document).ready(function(){     
      
      $('#health-information').parsley().on('field:success', function() {
        // In here, `this` is the parlsey instance of #some-input

        if ($('#health-information').parsley('isValid')) {
          console.log('form is valid');
          $('#submit').removeAttr('disabled');
        }
      });
       
      $("#w3review").tagsinput('items');
      $("#allergies_medications").tagsinput('items');

      $(".radio1 input").change(function(){ // bind a function to the change event
          if( $(this).is(":checked") ){ // check if the radio is checked
              var val = $(this).val(); // retrieve the value
              console.log(val);
              if(val == 1){
                $('.allergies_medications').fadeIn();
              }else{
                $('.allergies_medications').fadeOut();
              }
              
          }
      });
    });
 
    $(document).ready(function() {
      $(".submit").click(function() {
        // Show the loader before submitting the form
        $(".loader-container").show();

        // Perform your form submission logic here

        // For demonstration purposes, setTimeout is used to simulate a delay (replace with your actual form submission logic)
        setTimeout(function() {
          // Hide the loader after the form is submitted
         $(".loader-container").hide();
        }, 5000); // 2000 milliseconds (2 seconds) is an example, adjust as needed
      });
    });
      </script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush