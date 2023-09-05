@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mt-5 mb-5 pt-5">
    <div class="row ">
        <div class="col-md-6">
            <div class="user-info">
                <img class="user-img" src="{{asset('step/assets/images/user.png')}}">
                <p class="txt">Designed with the latest design trends</p>
                <p class="txt">Welcome latest design trends Designed with the latest design trendsDesigned with the
                    latest design trends </p>
            </div>

        </div>
        <div class="col-md-6">

            <form name="myForm" action="/action_page.php" method="get">
                <div class="row">
                    
                    <div class="col-md-12 verify">
                        <label for="lname">Choose a Password</label>
                        <input type="number" name="password" placeholder="" />
                        <p class="reshare"> <a href="">Show</a></p>
                        <p class="info">Please enter 8 or more characters</p>
                    </div>
                    <div class="col-md-12 verify">
                        <label for="lname">Confirm Password</label>
                        <input type="number" name="confirm_password" placeholder="" />
                        <p class="reshare"> <a href="">Show</a></p>
                        <p class="info">Please enter 8 or more characters</p>
                    </div>
                </div>
                <a type="button" href="{{route('frontend.auth.step.profile.completed')}}" class="next button" onclick="" >Next</a>

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