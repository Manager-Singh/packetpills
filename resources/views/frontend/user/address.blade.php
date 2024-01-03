@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
	<link rel="stylesheet" href="{{asset('website/assets/css/dashboard.css')}}">
  <style>
    .btn-div a {
    display: contents;
    }
  </style>
@endpush
@section('content')
<div class="container mt-0 mb-5 pt-0">
		    	<div class="row ">
				    <div class="col-md-12">
              <div class="user-info p-details">
                <i class="fa fa-home" aria-hidden="true"></i>
                @if(isset($_GET['id']) && isset($address))
                  <p class="txt-large">Update Shipping Address</p>
                @else
                <p class="txt-large">Add Shipping Address</p>
                @endif
                
             </div> 

				    </div>
            <div class="col-md-2">
              </div>
				    <div class="col-md-8">
            <form name="myForm" id="address-form" method='post' action="{{route('frontend.user.address.save')}}" enctype='multipart/form-data'>
              @csrf 
                <label for="address">Street Address</label>
                <input type="text" id="address" name="address1"  value="{{ (isset($address) && isset($address->address1)) ? $address->address1 : ''}}" placeholder="Address line 1" required><br><br>
                <input type="text" id="address" name="address2" value="{{ (isset($address) && isset($address->address2)) ? $address->address2 : ''}}" placeholder="Address line 2">

                <label for="zip">Postal Code</label>
                <input type="number" id="zip" data-parsley-type="number" name="postal_code" value="{{ (isset($address) && isset($address->postal_code)) ? $address->postal_code : ''}}" placeholder="Postal Code" required>

                <label for="city">City</label>
                <input type="text" id="city" name="city" value="{{ (isset($address) && isset($address->city)) ? $address->city : ''}}" placeholder="City" required>

                <label for="province">Province</label>
                <select name="province" id="province" required>
                  <option value="">Select a Province</option>
                  @if($provinces)
                    @foreach($provinces as $province)
                    <option value="{{$province->slug}}" {{ (isset($address) && $address->province == $province->slug) ? 'selected' : ''}}>{{$province->name}}</option>
                  
                    @endforeach
                  @else
                  @endif
                  <!-- <option value="British Columbia" {{ (isset($address) && $address->province == 'British Columbia') ? 'selected' : ''}}>British Columbia</option>
                  <option value="Manitoba" {{ (isset($address) && $address->province == 'Manitoba') ? 'selected' : ''}}>Manitoba</option>
                  <option value="New Brunswick" {{ (isset($address) && $address->province == 'New Brunswick') ? 'selected' : ''}}>New Brunswick</option>
                  <option value="Newfoundland and Labrador" {{ (isset($address) && $address->province == 'British Columbia') ? 'selected' : ''}}>Newfoundland and Labrador</option>
                  <option value="Northwest Territories" {{ (isset($address) && $address->province == 'Newfoundland and Labrador') ? 'selected' : ''}}>Northwest Territories</option>
                  <option value="Nova Scotia" {{ (isset($address) && $address->province == 'Nova Scotia') ? 'selected' : ''}}>Nova Scotia</option>
                  <option value="Nunavut" {{ (isset($address) && $address->province == 'Nunavut') ? 'selected' : ''}}>Nunavut</option>
                  <option value="Ontario" {{ (isset($address) && $address->province == 'Ontario') ? 'selected' : ''}}>Ontario</option>
                  <option value="Prince Edward Island" {{ (isset($address) && $address->province == 'Prince Edward Island') ? 'selected' : ''}}>Prince Edward Island</option>
                  <option value="Quebec" {{ (isset($address) && $address->province == 'Quebec') ? 'selected' : ''}}>Quebec</option>
                  <option value="Saskatchewan" {{ (isset($address) && $address->province == 'Saskatchewan') ? 'selected' : ''}}>Saskatchewan</option>
                  <option value="Yukon" {{ (isset($address) && $address->province == 'Yukon') ? 'selected' : ''}}>Yukon</option>
                 -->
                 </select>

                <label for="address">Address Type</label>
                <select name="address_type" id="address" required>
                  <option value="">Select a Address Type</option>
                  <option value="Billing Address" {{ (isset($address) && $address->address_type == 'Billing Address') ? 'selected' : ''}}>Billing Address</option>
                  <option value="Shipping/Delivery Address" {{ (isset($address) && $address->address_type == 'Shipping/Delivery Address') ? 'selected' : ''}}>Shipping/Delivery Address</option>
                 </select>

                <input type="checkbox" id="mark" name="mark_as" {{ (isset($address) && $address->mark_as == 'default') ? 'checked' : ''}} value="yes">
                <label for="mark"> Mark this as a default address</label>
                <div class="btn-div">
                  <a href="{{route('frontend.user.address')}}"   > <button type="button" class="save button"> Cancel </button></a>
                  @if(isset($_GET['id']) && isset($address))
                    <input type="hidden" name="id" value="{{$address->id}}"/>
                    <button type="submit" id ="submit" class="next button submit" onclick="" >Update</button>
                  @else
                    <button type="submit" id="submit" class="next button submit" onclick="" >Save</button>
                  @endif
                  
                 
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
      $('#address-form').parsley().on('field:success', function() {
        // In here, `this` is the parlsey instance of #some-input

        if ($('#address-form').parsley('isValid')) {
          $('#submit').removeAttr('disabled');
        }
      });  
     
    });
 

    $(document).ready(function() {
      $(".submit").click(function() {
        $('#address-form').parsley().validate();


        if ($('#address-form').parsley().isValid()) {
              $(".loader-container").show();
          }
        // Show the loader before submitting the form
        

        // Perform your form submission logic here
        
        // For demonstration purposes, setTimeout is used to simulate a delay (replace with your actual form submission logic)
        
        setTimeout(function() {
          // Hide the loader after the form is submitted
         
          //$(".loader-container").hide();
         
        }, 2000); // 2000 milliseconds (2 seconds) is an example, adjust as needed
      });
    });

      </script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush