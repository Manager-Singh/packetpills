@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mt-5 mb-5 pt-5">
		    	<div class="row ">
				    <div class="col-md-6">
              <div class="user-info">
                <i class="fa fa-address-card-o" aria-hidden="true"></i>
                <p class="txt-large">Your provincial Health Card</p>
                <p class="txt">Welcome latest design trends Designed with the latest design trendsDesigned with the latest design trends </p>
              </div> 

				    </div>
				    <div class="col-md-6">

                        <form name="myForm" action="" method="get">
                            <div class="row">
                            <div class="col-md-6">
                              <div class="upload">
                              <input type="file" id="myFile" name="filename">
                            
                              <label for="myfile"><i class="fa fa-camera" aria-hidden="true"></i> <br>Health Card <br>(front)</label>
                            </div>
                          </div>
                            <div class="col-md-6">
                              <div class="upload">
                              <input type="file" id="myFile" name="filename" >
                              
                              <label for="myfile"><i class="fa fa-camera" aria-hidden="true"></i> <br>Health Card <br>(back)</label>
                            </div>
                          </div>
                            <p class="info">You must be at least 14 year old.</p>
                           
                            </div>
                            <button type="button" class="next button" onclick="" >Continue</button>
                   
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