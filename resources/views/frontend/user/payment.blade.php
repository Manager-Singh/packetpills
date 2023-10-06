@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
	<link rel="stylesheet" href="{{asset('website/assets/css/dashboard.css')}}">
@endpush
@section('content')
<div class="container mt-0 mb-5 pt-0"> 
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
				    <div class="col-md-8" id="table">
            <form name="myForm" id="card-form" method='post' action="{{route('frontend.user.payment.save')}}" enctype='multipart/form-data'>
              @csrf 
                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" data-parsley-minlength="19" data-parsley-maxlength="19" maxlength=19 name="card_number"  value="" placeholder="Card Number" required><br><br>
                <div class="form-row">
                  <div class="form-group col-md-6">

                    <label for="zip">Expiry Month(MM)</label>
                    <input type="text" maxlength=2 id="expiry_month" name="expiry_month" value="" placeholder="Expiry(MM)" required>
                  </div>
                  <div class="form-group col-md-6 mt-0">

                    <label for="zip">Expiry Year(YY)</label>
                    <input type="text" maxlength=2 id="expiry_year" name="expiry_year" value="" placeholder="Expiry(YY)" required>
                  </div>

                </div>

                <label for="cvc">CVC</label>
                <input type="text" id="cvc" data-parsley-maxlength="3" maxlength="3"  name="cvc" value="" placeholder="CVC" required>

                <div class="row mt-3 payment-card">
                <label class="col-md-12" for="myfile">Payment Card</label>
                <div class="col-md-6">
                  <div class="upload">
                  <input type="file" required id="myFile" name="front_img" onchange="readURL(this);">
                    <label for="myfile">
                      <i class="fa fa-camera" aria-hidden="true"></i>
                      <br>Card <br>(front) </label>
                      <div class="upload-after">
                        
                        <img id="output" src="#" width="100%" />
                        <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        
                        	
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="upload" >
                  <input type="file" required id="myFile" name="back_img" onchange="readURL(this);">
                    <label  for="myfile">
                      <i class="fa fa-camera" aria-hidden="true"></i>
                      <br>Card <br>(back) </label>
                      <div class="upload-after" >
                      
                        <img id="output" src="#" width="100%" />
                        <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        
                      </div>
                  </div>
                </div>
              </div>

                <div class="btn-div">
                  <a href="{{route('frontend.user.payment')}}"><button type="button" class="save button" onclick="" > Cancel </button></a>
                  <button type="submit" id="submit" class="next button" onclick="" >Save</button>
                 
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

      $('#card-form').parsley().on('field:success', function() {
        // In here, `this` is the parlsey instance of #some-input

        if ($('#card-form').parsley('isValid')) {
          console.log('form is valid');
          $('#submit').removeAttr('disabled');
        }
      });  

      
    
       $('#card-number,#expiry_month,#expiry_year,#cvc').on('keyup',function(){
          //var number = $(this).val();
          console.log($(this));
          var val = $(this).val();
          var newval = '';
          val = val.replace(/\s/g, '');

          if (!/^\d*\.?\d*$/.test(val)) {
            val = val.substr(0,val.length-1);
          }
          
          
          if($(this).is('#expiry_year')){
            console.log('yyy');
            
            if(!expiryYearCheck()){
              $('#expiry_year').parsley();
              $('#expiry_year').addClass('js_error');
              $('#expiry_year').parsley().removeError('myError');
              $('#expiry_year').parsley().addError('myError', {message: 'Year Invalid'});
            }else{
              $('#expiry_year').parsley().removeError('myError');
              $('#expiry_year').removeClass('.js_error');
            }
               
               
          }

          if($(this).is('#cvc')){
            
            if(val.length < 3){
              $('#cvc').parsley();
              $('#cvc').addClass('js_error');
              $('#cvc').parsley().removeError('myError');
              $('#cvc').parsley().addError('myError', {message: 'Minimum 3 digit'});
            }else{
              $('#cvc').parsley().removeError('myError');
              $('#cvc').removeClass('.js_error');
            }
               
               
          }
          if($(this).is('#expiry_month') ){
            if(val > 12){
              $('#expiry_month').parsley();
              $('#expiry_month').addClass('js_error');
              $('#expiry_month').parsley().removeError('myError');
              $('#expiry_month').parsley().addError('myError', {message: 'Month Invalid'});
            }else{
              $('#expiry_month').parsley().removeError('myError');
              $('#expiry_month').removeClass('.js_error');
            }
          }

          for(var i=0; i < val.length; i++) {
            if(i%4 == 0 && i > 0) newval = newval.concat(' ');
            newval = newval.concat(val[i]);
          }
          
          $(this).val(newval);
       })


       $('#table').on('click', "#delete", function(e) {
        console.log($(this).closest('.upload-after').find('#output'));
        
        $(this).closest('.upload-after').find('#output').attr('src', '#').width(0).height(0);
        //$(this).closest('.upload-after').remove();
        $(this).closest('.upload-after').removeClass("d-block");
 
      });
     
    });

    function readURL(input) {
      //console.log($(input).parent());
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
          console.log($(input).parent());
          
          $(input).parent().find('#output').attr('src', e.target.result).width(150).height(200);
          $(input).parent().find('.upload-after').addClass("d-block");
        };

        reader.readAsDataURL(input.files[0]);
      }
    }

    function expiryYearCheck() {
      card_year = $('#expiry_year').val().toString();
      let current_year = new Date().getFullYear().toString().substr(2);
      if (card_year < current_year ) {
        return false;
      }
      return true;
    }

    function expiryMonthCheck() {

      card_month =$('#expiry_month').val();
      let current_month = new Date().getMonth(); 
      if ( card_month < current_month) {
        return false;
      }
      return true;
    }

function luhnCheck(val) {
    var sum = 0;
    for (var i = 0; i < val.length; i++) {
        var intVal = parseInt(val.substr(i, 1));
        if (i % 2 == 0) {
            intVal *= 2;
            if (intVal > 9) {
                intVal = 1 + (intVal % 10);
            }
        }
        sum += intVal;
    }
    return (sum % 10) == 0;
}
 

      </script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush