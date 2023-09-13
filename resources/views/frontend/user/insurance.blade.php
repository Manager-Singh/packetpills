@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mt-5 mb-5 pt-5">
		    	<div class="row ">
				    <div class="col-md-6">
              <div class="user-info">
                <i class="fa fa-address-card-o" aria-hidden="true"></i>
                <p class="txt-large">Your insurance details</p>
                <p class="txt">We direct bill all insurances and provincial plans like Pharmacare, OHIP+ and ODB. </p>
              </div> 

				    </div>
				    <div class="col-md-6">

                        <form name="myForm" method='post' action="{{route('frontend.user.insurance.save')}}" enctype='multipart/form-data'>
                        @csrf      
                        <div class="row">
                            <div class="col-md-6">
                              <div class="upload">
                              <input type="file" id="myFile" name="front_img">
                            
                              <label for="myfile"><i class="fa fa-camera" aria-hidden="true"></i> <br>Health Card <br>(front)</label>
                            </div>
                          </div>
                            <div class="col-md-6">
                              <div class="upload">
                              <input type="file" id="myFile" name="back_img" >
                              
                              <label for="myfile"><i class="fa fa-camera" aria-hidden="true"></i> <br>Health Card <br>(back)</label>
                            </div>
                          </div>
                            <p class="info">You must be at least 14 year old.</p>
                           
                            </div>
                            <button type="submit" class="next button" onclick="" >Continue</button>
                   
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