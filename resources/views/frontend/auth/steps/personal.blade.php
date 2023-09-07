@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mt-5 mb-5 pt-5">
		    	<div class="row ">
				    <div class="col-md-12">
              <div class="user-info">
                <img class="user-img" src="{{asset('step/assets/images/user.png')}}">
                <p class="txt">Hi, I'm Cathy, your pharmacist and I'll need some information to fill your orders & provide consultation.</p>
              </div>

				    </div>
            <div class="col-md-2">
</div>
				    <div class="col-md-8 mt-2">

                        <form name="myForm" id="personal-step" action="{{route('frontend.auth.step.personal.submit')}}" method="post">
                            @csrf
                            <div class="row">
                            <div class="col-md-6">
                            <label for="fname">First name</label>
                            <input type="text" id="fname" name="first_name" required>
                            </div>
                            <div class="col-md-6">
                            <label for="lname">Last name</label>
                            <input type="text" id="lname" name="last_name" required>
                            </div>
                            <div class="col-md-12">
                            <label for="lname">Date Of Birth</label>
                            <p class="info">You must be at least 14 year old.</p>
                            <span class="dob">
                                <input type="number" class="form-control" name="month" placeholder="MM" maxlength="2" size="2" required />

                                <input type="number" class="form-control" name="date" placeholder="DD" maxlength="2" size="2" required />

                                <input type="number" class="form-control"  name="year"  placeholder="YYYY" maxlength="4" size="4" required />
                            </span>
                            </div>
                            </div>
                            <input type="submit" class="next button" value="Next" />
                            <p class="info-bold">1 Day delivery in the Greater area</p>
                          </form>


                </div>
                <div class="col-md-2">
</div>


			</div>
		</div>
@endsection

@push('after-scripts')

<script type="text/javascript">
    $(document).ready(function() {
        $("#personal-step").parsley();
    });
</script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush
