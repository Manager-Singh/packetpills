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
            <form name="myForm" method='post' action="{{route('frontend.user.address.save')}}" enctype='multipart/form-data'>
              @csrf 
                <label for="address">Street Address</label>
                <input type="text" id="address" name="address1"  value="" placeholder="Address line 1"><br><br>
                <input type="text" id="address" name="address2" value="" placeholder="Address line 2">

                <label for="zip">Postal Code</label>
                <input type="text" id="zip" name="postal_code" value="" placeholder="Postal Code">

                <label for="city">City</label>
                <input type="text" id="city" name="city" value="" placeholder="City">

                <label for="province">Province</label>
                <select name="province" id="province">
                  <option value="">Select a Province</option>
                  <option value="Alberta">Alberta</option>
                  <option value="British Columbia">British Columbia</option>
                  <option value="Manitoba">Manitoba</option>
                  <option value="New Brunswick">New Brunswick</option>
                  <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                  <option value="Northwest Territories">Northwest Territories</option>
                  <option value="Nova Scotia">Nova Scotia</option>
                  <option value="Nunavut">Nunavut</option>
                  <option value="Ontario">Ontario</option>
                  <option value="Prince Edward Island">Prince Edward Island</option>
                  <option value="Quebec">Quebec</option>
                  <option value="Saskatchewan">Saskatchewan</option>
                  <option value="Yukon">Yukon</option>
                </select>

                <label for="address">Address Type</label>
                <select name="address_type" id="address">
                  <option value="">Select a Address Type</option>
                  <option value="Home">Home</option>
                  <option value="Work">Work</option>
                  <option value="Other">Other</option>
              
                </select>

                <input type="checkbox" id="mark" name="mark_as" value="yes">
                <label for="mark"> Mark this as a default address</label>
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