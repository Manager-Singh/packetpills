@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mt-5 mb-5 pt-5">
		    	<div class="row ">
				    <div class="col-md-6">
              <div class="user-info">
                <img class="user-img" src="{{asset('step/assets/images/user.png')}}">
                <p class="txt">Hi, I'm Cathy, your pharmacist and I'll need some information to fill your orders & provide consultation.</p>
              </div> 

				    </div>
				    <div class="col-md-6">

                        <form name="myForm" action="/action_page.php" method="get">
                            <div class="row">
                            <div class="col-md-6">
                            <label for="fname">First name</label>
                            <input type="text" id="fname" name="fname">
                            </div>
                            <div class="col-md-6">
                            <label for="lname">Last name</label>
                            <input type="text" id="lname" name="lname">
                            </div>
                            <div class="col-md-12">
                            <label for="lname">Date Of Birth</label>
                            <p class="info">You must be at least 14 year old.</p>
                            <span class="dob">
                                <input type="text" name="month" placeholder="MM" maxlength="2" size="2" />
                               
                                <input type="text" name="date" placeholder="DD" maxlength="2" size="2" />
                               
                                <input type="text" name="year" placeholder="YYYY" maxlength="4" size="4" />
                            </span>
                            </div>
                            </div>
                            <a type="button" href="{{route('frontend.auth.step.almostdone')}}" class="next button" onclick="" >Next</a>
                            <p class="info-bold">1 Day delivery in the Greater area</p>
                          </form>
                 
                 
                </div>
 
			
			</div>
		</div>
@endsection

@push('after-scripts')
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush