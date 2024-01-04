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
.service-selection-btn {
    position: absolute;
    right: 0;
    z-index: 5;
    background: #8ac03d !important;
    border-color: #638e3c !important;
}
.personal-main {
    position: relative;
}
</style>
@endpush
@section('content')

<div class="container mt-3 mb-5 pt-2 personal-main">
<a class="btn btn-primary btn-sm service-selection-btn" href="{{route('frontend.auth.service.selection')}}"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Service Selection</a>
                <form name="myForm" class="row" enctype="multipart/form-data" id="personal-step" action="{{route('frontend.auth.step.personal.submit')}}" method="post">
                            @csrf
				    <div class="col-md-12">
              <div class="user-info">
                <!-- <img class="user-img" src="{{asset('step/assets/images/user.png')}}"> -->
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' name="avatar_location" id="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"></label>
                    </div>
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
                            <input type="text" id="fname" name="first_name" value="{{$auth->first_name}}" required>
                            </div>
                            <div class="col-md-6">
                            <label for="lname">Last name</label>
                            <input type="text" id="lname" name="last_name" value="{{$auth->last_name}}"  required>
                            </div>
                            <div class="col-md-12">
                            <label for="lname">Date Of Birth</label>
                            <p class="info">You must be at least 14 year old.</p>
                            <span class="dob">
                                <input type="text" class="form-control orderUnits" name="month" value="{{$auth->dob('month')}}"  placeholder="MM" maxlength="2"  required />

                                <input type="text" class="form-control orderUnits1" name="date"  value="{{$auth->dob('day')}}" placeholder="DD" maxlength="2"  required />

                                <input type="text" class="form-control orderUnits2"  name="year"  value="{{$auth->dob('year')}}"  placeholder="YYYY" maxlength="4"  required />
                            </span>
                            </div>
                            </div>
                            <input type="submit" class="next button" value="Next" />
                            <p class="info-bold">3 Hours delivery for emergency medicines.</p>
                          


                </div>
                <div class="col-md-2">
</div>

</form>
			
		</div>
@endsection

@push('after-scripts')

<script type="text/javascript">
    $(document).ready(function() {
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


document.getElementsByClassName("orderUnits")[0].addEventListener("input", amountofUnits);
document.getElementsByClassName("orderUnits1")[0].addEventListener("input", amountofUnits);
document.getElementsByClassName("orderUnits2")[0].addEventListener("input", amountofUnits);

function amountofUnits() {
   this.value = this.value.replace(/[^\d]/, '')
}

</script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush
