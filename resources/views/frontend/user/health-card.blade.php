@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<link rel="stylesheet" href="{{asset('step/assets/css/after-login-style.css')}}">
	<style>
   .upload-after button.delete {
    position: absolute;
    right: 2px;
    bottom: 2px;
    border: 1px solid #638e3c;
    font-size: 20px;
    z-index: 999;
    color: #8ac03d;
}
  </style>
@endpush
@section('content')
<div class="container mt-0 mb-5 pt-0">
		    	<div class="row ">
				    <div class="col-md-12">
              <div class="user-info">
                <i class="fi fi-br-hospital-user fa"></i>
                <p class="txt-large">Your provincial Health Card</p>
              </div> 

				    </div>
				    <div class="row justify-content-center">
              <div class="col-md-7">

                        <form name="myForm" id="health-form" method='post' action="{{route('frontend.user.health.card.save')}}" enctype='multipart/form-data'>
                        @csrf      
                        <div class="row" id="table">
                            <div class="col-md-12">
                              <div class="group-form">
                                <label class="mt-0"  for="health-card-number">Confirm your health card number</label>
                                <input type="text" id="health-card-number" name="health_card_number"  value="{{($healthCard) ? $healthCard->card_number : ''}}" placeholder="Health Card Number" required><br><br>
                
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="upload">
                              @if(!$healthCard && !isset($healthCard->front_img) || $healthCard && empty($healthCard->front_img))
                              <input type="file" required id="myFile" name="front_img" onchange="readURL(this);">
                              @endif
                            
                              <label for="myfile"><i class="fa fa-camera" aria-hidden="true"></i> <br>Health Card <br>(front)</label>
                              <div class="upload-after" {{($healthCard && isset($healthCard->front_img)) ? 'style=display:block;' : ''}} >
                              @if($healthCard && isset($healthCard->front_img))
                            <img id="output" src="{{asset($healthCard->front_img)}}" width="100%" />
                            <button type="button" class="btn-sm delete" onclick="removeInsurance({{$healthCard->id}},'front_img')" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            @else
                            <img id="output" src="#" width="100%" />
                            <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            @endif	
                                
                              </div>
                            </div>
                          </div>
                            <div class="col-md-6">
                              <div class="upload">
                              @if(!$healthCard && !isset($healthCard->back_img) || $healthCard && empty($healthCard->back_img))
                              <input type="file" required id="myFile" name="back_img" onchange="readURL(this);"/>
                              @endif
                              
                              <label for="myfile"><i class="fa fa-camera" aria-hidden="true"></i> <br>Health Card <br>(back)</label>
                              <div class="upload-after" {{($healthCard && isset($healthCard->back_img)) ? 'style=display:block;' : ''}} >
                              @if($healthCard && isset($healthCard->back_img))
                            <img id="output" src="{{asset($healthCard->back_img)}}" width="100%" />
                            <button type="button" class="btn-sm delete" onclick="removeInsurance({{$healthCard->id}},'back_img')" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            @else
                            <img id="output" src="#" width="100%" />
                            <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            @endif	
                              </div>
                            </div>
                          </div>
                            <p class="info">You must be at least 14 year old.</p>
                            <div class="row">
                              <div class="col-md-8">
                              <div class="form-check">
                                <input class="form-check-input" name="odsp" type="checkbox" id="inlineCheckbox1" value="ODSP" {{(($healthCard && isset($healthCard->odsp)) && $healthCard->odsp == 'ODSP') ? 'checked' : ''}}>
                                <label class="form-check-label" for="inlineCheckbox1">ODSP</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" name="ohip" type="checkbox" id="inlineCheckbox2" value="OHIP+  (under 25 year old Ontario Program)" {{(($healthCard && isset($healthCard->ohip)) && $healthCard->ohip == 'OHIP+  (under 25 year old Ontario Program)') ? 'checked' : ''}}>
                                <label class="form-check-label" for="inlineCheckbox2">OHIP+  (under 25 year old Ontario Program)</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" name="trillium_program" type="checkbox" id="inlineCheckbox3" value="Trillium program" {{(($healthCard && isset($healthCard->trillium_program)) && $healthCard->trillium_program == 'Trillium program') ? 'checked' : ''}}>
                                <label class="form-check-label" for="inlineCheckbox3">Trillium program</label>
                              </div>
                            </div>

                            </div>
                           @if($healthCard)
                           <input type="hidden" name="health_id" value="{{$healthCard->id}}" />
                           <button type="submit" id="submit" class="next button submit" onclick="" >Update</button>
                           @else
                           <button type="submit" id="submit" class="next button submit" onclick="" >Continue</button>
                           @endif
                            </div>
                            
                   
                          </form>
                 
                 
            </div>
          </div>
 
			
			</div>
		</div>
@endsection

@push('after-scripts')
<script>
   
   $(document).ready(function(){  
    
    $('#health-form').parsley().on('field:success', function() {
        // In here, `this` is the parlsey instance of #some-input

        if ($('#health-form').parsley('isValid')) {
          
          $('#submit').removeAttr('disabled');
        }
      });



      var upload_count = 1;     
       
       
          
       $('#table').on('click', "#delete", function(e) {
        //console.log($(this).closest('.upload-after').find('#output'));
        
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
          //console.log($(input).parent());
          
          $(input).parent().find('#output').attr('src', e.target.result).width(150).height(200);
          $(input).parent().find('.upload-after').addClass("d-block");
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
 
    function removeInsurance(id,type) 
    {
       // console.log(id);
        
       
        swal({
            title: "Do you want to delete?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: false
            },
            function(){
                ajaxurl = "{{ route('frontend.user.health.card.delete') }}";
                            _token = "{{ csrf_token() }}";
                            $.ajax({
                                url: ajaxurl,
                                type: "POST",
                                data: {_token:_token,id:id,type:type},
                                success: function(data){
                                    if(data.success)
                                    {
                                        //$('.address-'+id).fadeOut('slow');
                                        swal("Success!", 'Health Card Deleted.', "success");
                                        location.reload();
                                    }
                                }
                            });
            });

        return false;


     
  }

  $(document).ready(function() {
      $(".submit").click(function() {
        $('#health-form').parsley().validate();
        if ($('#health-form').parsley().isValid()) {
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