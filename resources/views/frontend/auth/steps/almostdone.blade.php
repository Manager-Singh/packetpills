@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mt-5 mb-5 pt-5">
    <div class="row ">
        <div class="col-md-12">
            <div class="user-info">
                <img class="user-img" src="{{asset('step/assets/images/user.png')}}">
                <p class="txt">Great! We just need a few more details to complete your profile and then we can start adding family members to your account.</p>
            </div>

        </div>
        <div class="col-md-2">
</div>
        <div class="col-md-8 mt-2">

            <form name="myForm" action="{{route('frontend.auth.step.almostdone.submit')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="fname">Province</label>
                        <select name="province" id="province" required>
                        <option  value="">Select a Province</option>
                        <option  value="Alberta" {{ ( $auth->province == 'Alberta') ? 'selected' : ''}}>Alberta</option>
                        <option  value="British Columbia" {{ ( $auth->province == 'British Columbia') ? 'selected' : ''}}>British Columbia</option>
                        <option  value="Manitoba" {{ ( $auth->province == 'Manitoba') ? 'selected' : ''}}>Manitoba</option>
                        <option  value="New Brunswick" {{ ( $auth->province == 'New Brunswick') ? 'selected' : ''}}>New Brunswick</option>
                        <option  value="Newfoundland and Labrador" {{ ( $auth->province == 'Newfoundland and Labrador') ? 'selected' : ''}}>Newfoundland and Labrador</option>
                        <option  value="Northwest Territories" {{ ( $auth->province == 'Northwest Territories') ? 'selected' : ''}}>Northwest Territories</option>
                        <option  value="Nova Scotia" {{ ( $auth->province == 'Nova Scotia') ? 'selected' : ''}}>Nova Scotia</option>
                        <option  value="Nunavut" {{ ( $auth->province == 'Nunavut') ? 'selected' : ''}}>Nunavut</option>
                        <option  value="Ontario" {{ ( $auth->province == 'Ontario') ? 'selected' : ''}}>Ontario</option>
                        <option  value="Prince Edward Island" {{ ( $auth->province == 'Prince Edward Island') ? 'selected' : ''}}>Prince Edward Island</option>
                        <option  value="Quebec" {{ ( $auth->province == 'Quebec') ? 'selected' : ''}}>Quebec</option>
                        <option  value="Saskatchewan" {{ ( $auth->province == 'Saskatchewan') ? 'selected' : ''}}>Saskatchewan</option>
                        <option  value="Yukon" {{ ( $auth->province == 'Yukon') ? 'selected' : ''}}>Yukon</option>
                        </select>
                        <p class="info">As mentioned at least 14 year old.</p>
                    </div>
                    <div class="col-md-12">
                        <label for="lname">Gender</label>
                        <div class="gender-div">
                            <span class="gender">
                                <input type="radio" name="gender" {{ ( $auth->gender == 'Male') ? 'checked' : ''}} value="Male" required>
                                <label>Male</label>
                            </span>
                            <span class="gender">
                                <input type="radio" name="gender" {{ ( $auth->gender == 'Female') ? 'checked' : ''}} value="Female" required>
                                <label>Female</label>
                            </span>
                            <span class="gender">
                                <input type="radio" name="gender" {{ ( $auth->gender == 'Prefer to not share') ? 'checked' : ''}} value="Prefer to not share" required>
                                <label>Prefer to not share</label>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="lname">Email Address</label>
                        <input type="email" name="email" value="{{$auth->email}}" placeholder="" required />
                        <p class="info">To send updates about your order.</p>
                    </div>
                </div>
                <button type="submit" class="next button">Next</button>
            </form>


        </div>
        <div class="col-md-2">
</div>

    </div>
</div>
@endsection

@push('after-scripts')
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush
