@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
	<link rel="stylesheet" href="{{asset('website/assets/css/dashboard.css')}}">
  <style>
    .btn-div a {
    display: contents;
    }
    #shipping_instructions {
        border: 2px solid #638e3c;
    }
  </style>
@endpush
@section('content')
<div class="container mt-0 mb-5 pt-0">
		    	<div class="row ">
				    <div class="col-md-12">
              <div class="user-info p-details">
                <i class="fi fi-br-address-book fa"></i>
                @if(isset($_GET['id']) && isset($address))
                  <!-- <p class="txt-large">Update Address</p> -->
                @else
                <!-- <p class="txt-large">Address</p> -->
                @endif
                
             </div> 

				    </div>
				    <div class="col-md-12">
            <form name="myForm" id="address-form" method='post' action="{{route('frontend.user.address.save')}}" enctype='multipart/form-data'>
              @csrf 

              <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                  <h3>Shipping Address</h3>
                  </div>
                  <div class="col-md-12">
                
                <label for="address">Street Address*</label>
                <input type="text" id="address" name="address1"  value="{{ (isset($address) && isset($address->address1)) ? $address->address1 : ''}}" placeholder="Address line 1" required><br><br>
                <input type="text" id="address2" name="address2" value="{{ (isset($address) && isset($address->address2)) ? $address->address2 : ''}}" placeholder="Address line 2">

                <label for="zip">Postal Code*</label>
                <input type="text" id="zip"  name="postal_code" value="{{ (isset($address) && isset($address->postal_code)) ? $address->postal_code : ''}}" placeholder="Postal Code" required>

                <label for="city">City*</label>
                <input type="text" id="city" name="city" value="{{ (isset($address) && isset($address->city)) ? $address->city : ''}}" placeholder="City" required>

                <label for="province">Province*</label>
                <select name="province" id="province" required>
                  <option value="">Select a Province</option>
                  @if($provinces)
                    @foreach($provinces as $province)
                    <option value="{{$province->slug}}" {{ (isset($address) && $address->province == $province->name) ? 'selected' : ''}}>{{$province->name}}</option>
                  
                    @endforeach
                  @else
                  @endif
                  
                 </select>

              
                <div class="form-group">
                  <label for="shipping_instructions">Add shipping Instructions</label>
                  <textarea class="form-control" id="shipping_instructions" name="shipping_instructions" rows="3" placeholder="Add shipping Instructions">{{ (isset($address) && isset($address->city)) ? $address->city : ''}}</textarea>
                </div>
                <!-- <label for="address">Address Type</label> -->
                <!-- <select name="address_type" id="address" required>
                  <option value="">Select a Address Type</option>
                  <option value="Billing Address" {{ (isset($address) && $address->address_type == 'Billing Address') ? 'selected' : ''}}>Billing Address</option>
                  <option value="Shipping/Delivery Address" {{ (isset($address) && $address->address_type == 'Shipping/Delivery Address') ? 'selected' : ''}}>Shipping/Delivery Address</option>
                 </select> -->
                  

                <!-- <input type="checkbox" id="mark" name="mark_as" {{ (isset($address) && $address->mark_as == 'default') ? 'checked' : ''}} value="yes">
                <label for="mark"> Mark this as a default address</label> -->
                </div>

                  </div>
                </div>

                <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                    <h3>Billing Address</h3>
                  </div>
                  <div class="col-md-12">
                    
                    <label for="billing_address">Street Address*</label>
                    <input type="text" id="billing_address" name="billing_address1"  value="{{ (isset($address) && isset($address->address1)) ? $address->address1 : ''}}" placeholder="Billing Address line 1" required><br><br>
                    <input type="text" id="billing_address2" name="billing_address2" value="{{ (isset($address) && isset($address->address2)) ? $address->address2 : ''}}" placeholder="Billing Address line 2">

                    <label for="billing_zip">Postal Code*</label>
                    <input type="text" id="billing_zip"  name="billiing_postal_code" value="{{ (isset($address) && isset($address->postal_code)) ? $address->postal_code : ''}}" placeholder="Billing Postal Code" required>

                    <label for="billing_city">City*</label>
                    <input type="text" id="billing_city" name="billing_address_city" value="{{ (isset($address) && isset($address->city)) ? $address->city : ''}}" placeholder="Billing City" required>

                    <label for="billing-province">Province*</label>
                    <select name="billing_province" id="billing-province" required>
                      <option value="">Select a Province</option>
                      @if($provinces)
                        @foreach($provinces as $province)
                        <option value="{{$province->slug}}" {{ (isset($address) && $address->province == $province->name) ? 'selected' : ''}}>{{$province->name}}</option>
                      
                        @endforeach
                      @else
                      @endif
                      
                    </select>
                  </div>

                </div>
                
                </div>
                <div class="col-md-12">
                  <div class="form-check mt-4">
                    <input type="checkbox" name="same" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Add same billing address as Shipping address</label>
                  </div>
                </div>
                </div>
                @if(isset($_GET['id']) && isset($billing_address))
                <input type="hidden" name="billing_id" value="{{$billing_address->id}}"/>
                @endif

                <div class="btn-div">
                  <a href="{{route('frontend.user.address')}}"> 
                    <button type="button" class="save button"> Cancel </button></a>
                  @if(isset($_GET['id']) && isset($address))
                    <input type="hidden" name="id" value="{{$address->id}}"/>
                    <button type="submit" id ="submit" class="next button submit" onclick="" >Update</button>
                  @else
                    <button type="submit" id="submit" class="next button submit" onclick="" >Save</button>
                  @endif
                  
                 
                  </div>
              </form> 
                 
                 
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
      
      
      // make billing same as address
    $('input[name=same]').click(function() {
      //alert('Using the same address');  
      if ($("input[name=same]:checked").is(':checked')) { 
            $('#billing_address').val($('#address').val());
            $('#billing_address2').val($('#address2').val());
            $('#billing_zip').val($('#zip').val());             
            $('#billing_city').val($('#city').val());             
            var province = $('select[name=province] option:selected').val(); 
            $('select[name=billing_province]').val(province);
      }else{
          
            $('#billing_address').val('');
            $('#billing_address2').val('');
            $('#billing_zip').val('');             
            $('#billing_city').val('');             
            var province = ''; 
            $('select[name=billing_province]').val(province);
        
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