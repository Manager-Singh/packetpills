@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mt-5 mb-5 pt-5">
		    	<div class="row ">
				    <div class="col-md-12">
              <div class="user-info p-details">
                <i class="fa fa-heartbeat" aria-hidden="true"></i>
                <p class="txt-large">Health information</p>
                <p class="txt">Welcome latest design trends Designed with the latest design trendsDesigned with the latest design trends </p>
              </div> 

				    </div>
            <div class="col-md-2">
              </div>
				    <div class="col-md-8">

                        <form name="myForm" action="" method="get">
                     
                            <label for="lname">Do you have allergies to any medications?</label>
                            <div class="radio">
                                <input type="radio" name="gender" value="Male">
                                <label>Yes</label>
                            
                           
                                <input type="radio" name="gender" value="Female">
                                <label>No</label> 
                           
                            </div>
                            <label for="lname">Enter any over the counter supplements and medications that you are taking</label>
                            <textarea id="w3review" name="w3review" rows="6" cols="100"></textarea>
                            
                            <button type="button" class="next button" onclick="" >Save</button>
                            
                   
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
       
     
    });
 

      </script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush