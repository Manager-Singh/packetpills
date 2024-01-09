@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<style>

.avatar-upload {
  position: relative;
  max-width: 124px;
  margin: 50px auto;
}
.avatar-upload .avatar-edit {
    position: absolute;
    right: 25px;
    z-index: 1;
    top: -4px;
}
.avatar-upload .avatar-edit input {
  display: none;
}
.avatar-upload .avatar-edit input + label {
    display: inline-block;
    width: 30px;
    height: 30px;
    margin-bottom: 0;
    border-radius: 100%;
    background: #FFFFFF;
    border: 1px solid transparent;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    font-weight: normal;
    transition: all 0.2s ease-in-out;
}
.avatar-upload .avatar-edit input + label:hover {
  background: #f1f1f1;
  border-color: #d6d6d6;
}
.avatar-upload .avatar-edit input + label:after {
    content: "\f040";
    font-family: 'FontAwesome';
    color: #638e3c;
    position: absolute;
    top: 8px;
    left: 0;
    right: 0;
    text-align: center;
    margin: auto;
}
.avatar-upload .avatar-preview {
    width: 100px;
    height: 100px;
    position: relative;
    border-radius: 100%;
    /* border: 2px solid #638e3c; */
    box-shadow: 0px 0px 6px 2px #638e3c;
}
.avatar-upload .avatar-preview > div {
  width: 100%;
  height: 100%;
  border-radius: 100%;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}

.avatar-upload label {
    margin: 8px 0;
}
</style>
@endpush
@section('content')

<div class="container mt-0 mb-5 pt-0">
		    	
        <form name="myForm" class="row" enctype="multipart/form-data" id="add-member" action="{{route('frontend.user.add.member.save')}}" method="post">
            @csrf
				    <div class="col-md-12">
              <div class="user-info">
                <!-- <img class="user-img" src="{{asset('step/assets/images/user.png')}}"> -->
                <div class="avatar-upload">
                    
                    <div class="avatar-preview">
                        <div id="imagePreview" style="background-image: url({{asset('step/assets/images/user.png')}});">
                        </div>
                    </div>
                </div>
                <p class="txt">Hi, I'm Alex, your pharmacist and I'll need some information to fill your orders & provide consultation.</p>
             
                

            </div>

				    </div>
            <div class="col-md-2">
</div>
      <div class="col-md-8 mt-2">
        <div class="row">
          <div class="col-md-6">
            <label for="fname">First name</label>
            <input type="text" id="fname" name="first_name" value="" required>
          </div>
          <div class="col-md-6">
            <label for="lname">Last name</label>
            <input type="text" id="lname" name="last_name" value=""  required>
          </div>
          
          <!-- <div class="col-md-6">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="">
          </div>
          <div class="col-md-6">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" value=""  required>
          </div> -->
          <div class="col-md-12">
            <label for="phone-no">Family Member Telephone Number.</label>
            <input type="number" id="phone-no" name="phone_no" value="">
          </div>
          <div class="col-md-12">
            <label for="lname">Date Of Birth</label>
            <span class="dob">
              <input type="number" class="" name="month" value=""  placeholder="MM" maxlength="2" size="2" required />

              <input type="number" class="" name="date"  value="" placeholder="DD" maxlength="2" size="2" required />

              <input type="number" class=""  name="year"  value=""  placeholder="YYYY" maxlength="4" size="4" required />
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="lname">Gender</label>
            <div class="gender-div">
                <span class="gender">
                    <input type="radio" id="male" name="gender"  value="Male" required>
                    <label for="male">Male</label>
                </span>
                <span class="gender">
                    <input type="radio" id="female" name="gender" value="Female" required>
                    <label for="female">Female</label>
                </span>
                <span class="gender">
                    <input type="radio" id="prefer-tonot-share" name="gender"  value="Prefer to not share" required>
                    <label for="prefer-tonot-share">Prefer to not share</label>
                </span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="lname">Relationship</label>
            <div class="gender-div relation-btn">
                <span class="gender">
                    <input type="radio" id="spouse" name="relationship"  value="spouse" required>
                    <label for="spouse">Spouse</label>
                </span>
                <span class="gender">
                    <input type="radio" id="child" name="relationship" value="child" required>
                    <label for="child">Child</label>
                </span>
                <span class="gender">
                    <input type="radio" id="other" name="relationship"  value="Other" required>
                    <label for="other">Other</label>
                </span>
            </div>
          </div>
            <div class="col-md-12 other-relation mt-4" style="display:none;">
              <label for="other_text">Other Relation</label>
              <input type="text" name="relationship_type" id="other_text" />
            </div>

          <div class="col-md-12">
            <input type="submit" id="submit" class="next button mt-4" value="Submit" />
          </div>
        </div>

        
        
        
      </div>
      <div class="col-md-2">
      </div>



</form>
			
		</div>
@endsection

@push('after-scripts')

<script type="text/javascript">
    $(document).ready(function() {


      $('#add-member').parsley().on('field:success', function() {
        // In here, `this` is the parlsey instance of #some-input

        if ($('#add-member').parsley('isValid')) {
          console.log('form is valid');
          $('#submit').removeAttr('disabled');
        }
      }); 
      $('.relation-btn >').on('change','input',function(){
        console.log('sdfsdf');
        console.log($(this).val());
        if($(this).val() == 'Other'){
          $('.other-relation').fadeIn();
        }else{
          $('.other-relation').fadeOut();
        }

      })


        $("#personal-step").parsley();
        $("#imageUpload").change(function() {
            readURL(this);
        });
    });


    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

</script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush
