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

                        <form name="myForm" method='post' action="{{route('frontend.user.health.card.save')}}" enctype='multipart/form-data'>
                        @csrf      
                        <div class="row" id="table">
                            <div class="col-md-6">
                              <div class="upload">
                              <input type="file" id="myFile" name="front_img" onchange="readURL(this);">
                            
                              <label for="myfile"><i class="fa fa-camera" aria-hidden="true"></i> <br>Health Card <br>(front)</label>
                              <div class="upload-after" >
                                <img id="output" src="#" width="100%" onchange="readURL(this);"/>	
                                <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                              </div>
                            </div>
                          </div>
                            <div class="col-md-6">
                              <div class="upload">
                              <input type="file" id="myFile" name="back_img" onchange="readURL(this);"/>
                              
                              <label for="myfile"><i class="fa fa-camera" aria-hidden="true"></i> <br>Health Card <br>(back)</label>
                              <div class="upload-after" >
                                <img id="output" src="#" width="100%" onchange="readURL(this);"/>	
                                <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                              </div>
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
      var upload_count = 1;     
       
       
          
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
 

      </script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush