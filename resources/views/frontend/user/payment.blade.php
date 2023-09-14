@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
	<link rel="stylesheet" href="{{asset('website/assets/css/dashboard.css')}}">
@endpush
@section('content')
<div class="container mt-5 mb-5 pt-5">
		    	<div class="row ">
				    <div class="col-md-12">
              <div class="user-info p-details">
                <i class="fa fa-home" aria-hidden="true"></i>
                <p class="txt-large">Add Shipping Address</p>
                <p class="txt">Welcome latest design trends Designed with the latest design trendsDesigned with the latest design trends </p>
              </div> 

				    </div>
            <div class="col-md-2">
              </div>
				    <div class="col-md-8">
            <form name="myForm" method='post' action="{{route('frontend.user.payment.save')}}" enctype='multipart/form-data'>
              @csrf 
                <label for="address">Card Number</label>
                <input type="number" id="address" name="card_number"  value="" placeholder="Card Number"><br><br>
                
                <label for="zip">Expiry(MMYY)</label>
                <input type="date" id="zip" name="expiry_date" value="" placeholder="Expiry(MMYY)">

                <label for="city">CVC</label>
                <input type="number" id="city" name="cvc" value="" placeholder="CVC">

                

                <div class="btn-div">
                  <button type="button" class="save button" onclick="" > Cancel </button>
                  <button type="submit" class="next button" onclick="" >Save</button>
                 
                  </div>
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