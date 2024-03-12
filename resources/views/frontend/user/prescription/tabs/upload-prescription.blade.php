@extends('frontend.layouts.step')
@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@section('content')
<div class="container mt-0 mb-5 pt-0">
		    	<div class="row ">
				    <div class="col-md-6">
              <div class="user-info">
                <img class="user-img" src="{{asset('step/assets/images/user.png')}}">
                <p class="txt">Add your prescription here.</p>
                <p class="txt">You can upload 1 to 8 prescription images. </p>
              </div> 

				    </div>
				    <div class="col-md-6">
 
              <form method='post' action="{{route('frontend.user.prescription.upload.save')}}" enctype='multipart/form-data'>
              @csrf  
              <div class="row add_row " id="table" width="100%">
               
                <div class="col-md-6 mt-3">
                  
                    
                  <div class="upload">
                      <input class="file" id="myFile" name="prescription_upload[]" type="file" onchange="readURL(this);" multiple required/>
                      <label for="myfile"><i class="fa fa-camera" aria-hidden="true"></i> <br>Upload or take a picture <br>(page 1)</label>
                      <div class="upload-after" >
                        <img id="output" src="#" width="100%" />	
                        <button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button>
                      </div>
                    </div>
                </div>
               

                <div class="col-md-6 add-btn mt-3">
                  <button class="btn btn-success btn-sm" type="button" id="add" title='Add new file'/><i class="fa fa-plus" aria-hidden="true"></i> <br>Add Page</button>
                </div>
              </div>
              <div class="d-flex">

                <a class="next button" href="{{route('frontend.user.dashboard')}}">Cancel</a>
                <button type="submit"class="next button submit" onclick="" >Continue</button>

              </div>
              <div class="text-center">
                <a class="next button text-decoration-none" href="{{route('frontend.user.prescription')}}">View All Prescriptions</a>
              </div>
              
            
 
                </form>
                 
                 
                </div>
 
			
			</div>
		</div>
@endsection

@push('after-scripts')
<script>
    //   $(document).ready(function(){      
    //     var upload_count = 1; 
       
    //      $('#table').on('click', "#add", function(e) {
    //         upload_count += 1;
    //         if(upload_count <= 8 ){
    //             $('.add_row').append('<div class="col-md-6 mt-3"><div class="upload"><input class="file" id="myFile" name="prescription_upload[]"" type="file"  /><label for="myfile"><i class="fa fa-camera" aria-hidden="true"></i> <br>Upload or take a picture <br>(page '+upload_count+')</label></div></div>');
       
    //         }
    //     e.preventDefault();
        
    //      });
            

    //   });
    $(document).ready(function(){   
      var upload_count = 1;     
       
       $('#table').on('click', "#add", function(e) {
        upload_count += 1;
        if(upload_count <= 8 ){
            $('.add_row').append('<div class="col-md-6 mt-3"><div class="upload"><input class="file" id="myFile" name="prescription_upload[]" type="file" onchange="readURL(this);" multiple /><label for="myfile"><i class="fa fa-camera" aria-hidden="true"></i> <br>Upload or take a picture <br>(page '+upload_count+')</label> <div class="upload-after" ><img id="output" src="#" width="100%" />	<button type="button" class="btn-sm" id="delete" title="Delete file"><i class="fa fa-trash" aria-hidden="true"></i></button> </div></div></div>');
          }
          if(upload_count == 8){
            $(this).fadeOut();
          }
      e.preventDefault();
       });
          
       $('#table').on('click', "#delete", function(e) {
        
        $(this).closest('.upload-after').find('#output').attr('src', '#').width(0).height(0);
        //$(this).closest('.upload-after').remove();
        $(this).closest('.upload-after').removeClass("d-block");
 
      });
    });
 

    function readURL(input) {
      
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          console.log($(input).parent());

          var fileExtension = input.files[0].name.split('.').pop().toLowerCase();
          if (fileExtension === 'pdf') {
            //$('#output').attr('data', e.target.result);
            $(input).parent().find('#output').attr('src', "{{ asset('img/pdf.png') }}").width(150).height(200);

          $(input).parent().find('.upload-after').addClass("d-block");

          }else{
            $(input).parent().find('#output').attr('src', e.target.result).width(150).height(200);
            $(input).parent().find('.upload-after').addClass("d-block");
          }
          
          
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
      </script>

<script>
    $(document).ready(function() {
      $(".submit").click(function() {
        // Show the loader before submitting the form
        $(".loader-container").show();

        // Perform your form submission logic here

        // For demonstration purposes, setTimeout is used to simulate a delay (replace with your actual form submission logic)
        setTimeout(function() {
          // Hide the loader after the form is submitted
          $(".loader-container").hide();
        }, 2000); // 2000 milliseconds (2 seconds) is an example, adjust as needed
      });
    });
  </script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush