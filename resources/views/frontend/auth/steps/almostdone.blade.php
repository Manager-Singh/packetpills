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

            <form name="myForm" action="{{route('frontend.auth.step.almostdone.submit')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="fname">Province</label>
                        <select name="province" id="province">
                        <option  value="">Select a Province</option>
                        <option  value="Alberta">Alberta</option>
                        <option  value="British Columbia">British Columbia</option>
                        <option  value="Manitoba">Manitoba</option>
                        <option  value="New Brunswick">New Brunswick</option>
                        <option  value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                        <option  value="Northwest Territories">Northwest Territories</option>
                        <option  value="Nova Scotia">Nova Scotia</option>
                        <option  value="Nunavut">Nunavut</option>
                        <option  value="Ontario">Ontario</option>
                        <option  value="Prince Edward Island">Prince Edward Island</option>
                        <option  value="Quebec">Quebec</option>
                        <option  value="Saskatchewan">Saskatchewan</option>
                        <option  value="Yukon">Yukon</option>
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
                <button type="submit" class="next button">Next</button>
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
