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

                        <form name="myForm" method='post' action="{{route('frontend.user.health.information.save')}}" enctype='multipart/form-data'>
                     @csrf
                            <label for="lname">Do you have allergies to any medications?</label>
                            <div class="radio1">
                                <input type="radio" id="yes" name="allergie" value="1" {{ ($health_info && $health_info->allergies == 1) ? 'checked' : '' }}/>
                                <label for="yes">Yes</label>
                            
                           
                                <input type="radio" id="no" name="allergie" value="0" {{ ($health_info && $health_info->allergies == 0) ? 'checked' : '' }}/>
                                <label for="no">No</label> 
                           
                            </div>
                            <label for="lname">Enter any over the counter supplements and medications that you are taking</label>
                            <textarea id="w3review" name="supplement_medicaton" rows="6" cols="100" placeholder="(e.g. Vitamin A, etc)" required>{{ ($health_info) ? $health_info->supplements_medications : '' }}</textarea>
                            
                            <button type="submit" class="next button" onclick="" >Save</button>
                            
                                
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