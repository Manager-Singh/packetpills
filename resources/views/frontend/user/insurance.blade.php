@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<link rel="stylesheet" href="{{asset('step/assets/css/after-login-style.css')}}">
<style>
.next.button {
    margin-left: 0px !important;
}
.no-inurance{
    width: 20px;
    height: 16px;
    border-radius: 6px;
    border: 2px solid #638e3c !important;
    padding: 12px;
    margin-right: 6px;
}
 .common-insurance{
  pointer-events: auto;
} 
</style>
@endpush
@section('content')
<div class="container mt-0 mb-5 pt-0 insurance-pg">
        <div class="row ">
          <div class="col-md-12">
            <div class="user-info p-details">
              <i class="fi fi-br-compliance-clipboard fa"></i>
              <p class="txt-large">Your insurance details</p>
            </div>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-8" id="table">
          <form name="myForm" id="insurance-form" class ="{{ ($is_insurance) ? 'is_insurance' :  '' }}" method='post' action="{{route('frontend.user.insurance.save')}}" enctype='multipart/form-data'>
          @csrf 
              <div class="row">
                <div class="col-md-12">
                
                <label class="mt-0" for="noInsurance">
                  <input type="checkbox" class="no-inurance" id="noInsurance" name="is_insurance" {{ ($is_insurance) ? "checked" :  "" }}  value="1" >
                   As of today's date - I certify that I have no private drug insurance/ coverage.
                  </label>
                
                </div>
              </div>
              <div class="row mt-3 common-insurance primary-insurance">
                <label class="col-md-12" for="myfile">Primary Insurance</label>
                <div class="col-md-6">
                  <div class="upload">
                  <input type="file" id="myFile" name="front_img" class="primary-insurance-input" onchange="readURL(this);">
                    <label for="myfile">
                      <i class="fa fa-camera" aria-hidden="true"></i>
                      <br>Upload <br>(front) </label>
                      <div class="upload-after"  {{($primary_insurance && isset($primary_insurance->front_img)) ? 'style=display:block;' : ''}}>
                        @if($primary_insurance && isset($primary_insurance->front_img))
                        <img id="output" src="{{asset($primary_insurance->front_img)}}" width="100%" />
                        <button type="button" class="btn-sm"  onclick="removeInsurance({{$primary_insurance->id}})" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @else
                        <img id="output" src="#" width="100%" />
                        <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @endif
                        	
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="upload" >
                  <input type="file" id="myFile"  name="back_img" class="primary-insurance-input" onchange="readURL(this);">
                    <label  for="myfile">
                      <i class="fa fa-camera" aria-hidden="true"></i>
                      <br>Upload <br>(back) </label>
                      <div class="upload-after" {{($primary_insurance && isset($primary_insurance->back_img)) ? 'style=display:block;' : ''}} >
                      @if($primary_insurance && isset($primary_insurance->back_img))
                        <img id="output" src="{{asset($primary_insurance->back_img)}}" width="100%" />
                        <button type="button" class="btn-sm"  onclick="removeInsurance({{$primary_insurance->id}})" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @else
                        <img id="output" src="#" width="100%" />
                        <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @endif	
                      </div>
                  </div>
                </div>
              </div>
              <div class="row mt-3 common-insurance secondary-insurance" {{ (isset($secondary_insurance)) ? '' : 'style=display:none;' }}>
                <label class="col-md-12" for="myfile">Secondary Insurance</label>
                <div class="col-md-6">
                  <div class="upload" >
                    <input type="file" id="myFile" name="secondary_front_img" onchange="readURL(this);">
                    <label for="myfile">
                      <i class="fa fa-camera" aria-hidden="true"></i>
                      <br>Upload <br>(front) </label>
                      <div class="upload-after" {{($secondary_insurance && isset($secondary_insurance->front_img)) ? 'style=display:block;' : ''}} >
                      @if($secondary_insurance && isset($secondary_insurance->front_img))
                        <img id="output" src="{{asset($secondary_insurance->front_img)}}" width="100%" /><button type="button" class="btn-sm"  onclick="removeInsurance({{$secondary_insurance->id}})" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @else
                        <img id="output" src="#" width="100%" />
                        <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @endif	
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="upload">
                    <input type="file" id="myFile" name="secondary_back_img" onchange="readURL(this);">
                    <label for="myfile">
                      <i class="fa fa-camera" aria-hidden="true"></i>
                      <br>Upload <br>(back) </label>
                      <div class="upload-after" {{($secondary_insurance && isset($secondary_insurance->back_img)) ? 'style=display:block;' : ''}} >
                      @if($secondary_insurance && isset($secondary_insurance->back_img))
                        <img id="output" src="{{asset($secondary_insurance->back_img)}}" width="100%" />
                        <button type="button" class="btn-sm" onclick="removeInsurance({{$secondary_insurance->id}})" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @else
                        <img id="output" src="#" width="100%" />
                        <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @endif	
                      </div>
                  </div>
                </div>
              </div>
              <div class="row mt-3  common-insurance tertiary-insurance" {{ (isset($tertiary_insurance)) ? '' : 'style=display:none;' }}>
                <label class="col-md-12" for="myfile">Tertiary Insurance</label>
                <div class="col-md-6">
                  <div class="upload">
                    <input type="file" id="myFile" name="tertiary_front_img" onchange="readURL(this);">
                    <label for="myfile">
                      <i class="fa fa-camera" aria-hidden="true"></i>
                      <br>Upload <br>(front) </label>
                      <div class="upload-after" {{($tertiary_insurance && isset($tertiary_insurance->front_img)) ? 'style=display:block;' : ''}} >
                      @if($tertiary_insurance && isset($tertiary_insurance->front_img))
                        <img id="output" src="{{asset($tertiary_insurance->front_img)}}" width="100%" />
                        <button type="button" class="btn-sm"  onclick="removeInsurance({{$tertiary_insurance->id}})" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @else
                        <img id="output" src="#" width="100%" />
                        <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @endif		
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="upload">
                    <input type="file" id="myFile" name="tertiary_back_img" onchange="readURL(this);">
                    <label for="myfile">
                      <i class="fa fa-camera" aria-hidden="true"></i>
                      <br>Upload <br>(back) </label>
                      <div class="upload-after" {{($tertiary_insurance && isset($tertiary_insurance->back_img)) ? 'style=display:block;' : ''}} >
                      @if($tertiary_insurance && isset($tertiary_insurance->back_img))
                        <img id="output" src="{{asset($tertiary_insurance->back_img)}}" width="100%" />
                        <button type="button" class="btn-sm"  onclick="removeInsurance({{$tertiary_insurance->id}})" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @else
                        <img id="output" src="#" width="100%" />
                        <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @endif	
                      </div>
                  </div>
                </div>
              </div>
              <div class="row mt-3 common-insurance quaternary-insurance" {{ (isset($quaternary_insurance)) ? '' : 'style=display:none;' }}>
                <label class="col-md-12" for="myfile">Quaternary Insurance</label>
                <div class="col-md-6">
                  <div class="upload">
                  <input type="file" id="myFile" name="quaternary_front_img" onchange="readURL(this);">
                    <label for="myfile">
                      <i class="fa fa-camera" aria-hidden="true"></i>
                      <br>Upload <br>(front) </label>
                      <div class="upload-after" {{($quaternary_insurance && isset($quaternary_insurance->front_img)) ? 'style=display:block;' : ''}} >
                      @if($quaternary_insurance && isset($quaternary_insurance->front_img))
                        <img id="output" src="{{asset($quaternary_insurance->front_img)}}" width="100%" />
                        <button type="button" class="btn-sm" onclick="removeInsurance({{$quaternary_insurance->id}})" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @else
                        <img id="output" src="#" width="100%" />
                        <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @endif	
                        <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="upload">
                    <input type="file" id="myFile" name="quaternary_back_img" onchange="readURL(this);">
                    <label for="myfile">
                      <i class="fa fa-camera" aria-hidden="true"></i>
                      <br>Upload <br>(back) </label>
                      <div class="upload-after"  {{($quaternary_insurance && isset($quaternary_insurance->back_img)) ? 'style=display:block;' : ''}}>
                      @if($quaternary_insurance && isset($quaternary_insurance->back_img))
                        <img id="output" src="{{asset($quaternary_insurance->back_img)}}" width="100%" />
                        <button type="button" class="btn-sm"  onclick="removeInsurance({{$quaternary_insurance->id}})" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @else
                        <img id="output" src="#" width="100%" />
                        <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        @endif		
                        
                      </div>
                  </div>
                </div>
              </div>
                <div class="order-footer common-insurance mt-5">
              @if(isset($quaternary_insurance))
              @else
              <a class="btn-big add-more-insurance" href="javascript:void(0)">+ Add more insurance</a>
              @endif
                    
                </div>
              <button type="submit" id="submit" class="next button submit" onclick="">Save</button>
            </form>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>

@endsection

@push('after-scripts')
<script>
    if($('#insurance-form').hasClass("is_insurance")) {
      $('.common-insurance').css("pointer-events","none");
      $(".primary-insurance-input").attr('required', false);
    } 


     $('#noInsurance').click(function() {
           
           

          
                if ($(this).prop("checked") == true) {
                
                  $('.common-insurance').css("pointer-events","none");
                  $(".primary-insurance-input").attr('required', false);
               


          swal({
            title: "Do you want to save?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Yes",
            closeOnConfirm: false
            },
            function(){
              swal.close();
                $(".loader-container").show();
                $('.submit').trigger('click');
                  
                         
            });
                
                } else {
                    
                   $('.common-insurance').css("pointer-events","auto");
                   //$(".common-insurance input").attr("required"); 
                   $(".primary-insurance-input").attr('required', true);
                   
                }
                 
            });
   
   $(document).ready(function(){   
      var upload_count = 1;     
      var clicks = 0;
       $('.add-more-insurance').on('click',function(){
        clicks += 1;
        
          if(!$('.secondary-insurance').hasClass('active')){

            $('.secondary-insurance').addClass('active');
            $('.secondary-insurance').fadeIn();

          }else{

            if(!$('.tertiary-insurance').hasClass('active')){

              $('.tertiary-insurance').addClass('active');
              $('.tertiary-insurance').fadeIn();
            }else{

              if(!$('.quaternary-insurance').hasClass('active')){
                $('.quaternary-insurance').addClass('active');
                $('.quaternary-insurance').fadeIn();
                $(this).fadeOut();
              }


            }
          }


       });
          
       $('#table').on('click', "#delete", function(e) {
        console.log($(this).closest('.upload-after').find('#output'));
        
        $(this).closest('.upload-after').find('#output').attr('src', '#').width(0).height(0);
        //$(this).closest('.upload-after').remove();
        $(this).closest('.upload-after').removeClass("d-block");
 
      });

      $('#insurance-form').parsley().on('field:success', function() {
        // In here, `this` is the parlsey instance of #some-input

        if ($('#insurance-form').parsley('isValid')) {
         
          $('#submit').removeAttr('disabled');
        }
      }); 
    });
 

    function readURL(input) {
      //console.log($(input).parent());
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
         
          $(input).parent().find('#output').attr('src', e.target.result).width(150).height(200);
          $(input).parent().find('.upload-after').addClass("d-block");
        };

        reader.readAsDataURL(input.files[0]);
      }
    }


    function removeInsurance(id) 
    {
        
        swal({
            title: "Do you want to proceed with this?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: false
            },
            function(){
                ajaxurl = "{{ route('frontend.user.insurance.delete') }}";
                            _token = "{{ csrf_token() }}";
                            $.ajax({
                                url: ajaxurl,
                                type: "POST",
                                data: {_token:_token,id:id},
                                success: function(data){
                                    if(data.success)
                                    {
                                        //$('.address-'+id).fadeOut('slow');
                                        swal("Success!", 'Insurance Deleted.', "success");
                                        location.reload();
                                    }
                                }
                            });
            });

        return false;


     
    }
 
    $(document).ready(function() {
      $(".submit").click(function() {
        //$('#insurance-form').parsley().validate();

        submitForm();

       // $('#noInsurance').parsley().isValid();
       
      //  $(".loader-container").show();

       // $(".loader-container").hide();
              
        // Show the loader before submitting the form
        

        // Perform your form submission logic here
        
        // For demonstration purposes, setTimeout is used to simulate a delay (replace with your actual form submission logic)
        
        setTimeout(function() {
          // Hide the loader after the form is submitted
         
          //$(".loader-container").hide();
         
        }, 5000); // 2000 milliseconds (2 seconds) is an example, adjust as needed
      });
    });

    function submitForm(){


      if ($('#noInsurance').prop("checked") == true) {
          
          $(".primary-insurance-input").attr('required', false);
          $('#insurance-form').parsley().validate();
          $('#noInsurance').parsley().isValid();
          $(".loader-container").show();
        }else{
          $(".primary-insurance-input").attr('required', true);
          
          if($('#insurance-form').parsley().validate()){
            $(".loader-container").show();
          }else{
            return false;
          }
         
        }

    }
      </script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush