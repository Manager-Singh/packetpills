@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mt-5 mb-5 pt-5">
    <div class="row ">
        <div class="col-md-6">
            <div class="user-info">
                <img class="user-img" src="{{asset('step/assets/images/user.png')}}">
                <p class="txt">Great! We just need a few more details to complete your profile and then we can start adding family members to your account.</p>
            </div>

        </div>
        <div class="col-md-6">

            <form name="myForm" action="/action_page.php" method="get">
                <div class="row">
                    <div class="col-md-12">
                        <label for="fname">Province</label>
                        <select name="city" id="province">
                            <option value="">Ontario</option>
                            <option value="">Ontario2</option>
                            <option value="">Ontario3</option>
                            <option value="">Ontario4</option>
                        </select>
                        <p class="info">As mentioned at least 14 year old.</p>
                    </div>
                    <div class="col-md-12">
                        <label for="lname">Gender</label>
                        <div class="gender-div">
                            <span class="gender">
                                <input type="radio" name="gender" value="Male">
                                <label>Male</label>
                            </span>
                            <span class="gender">
                                <input type="radio" name="gender" value="Female">
                                <label>Female</label>
                            </span>
                            <span class="gender">
                                <input type="radio" name="gender" value="Other">
                                <label>Other</label>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="lname">Email Address</label>
                        <input type="email" name="email" placeholder="" />
                        <p class="info">To send updates about your order.</p>
                    </div>
                </div>
                <a type="button" href="{{route('frontend.auth.step.create.password')}}" class="next button" onclick="" >Next</a>
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