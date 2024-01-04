@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<style>
.almostdone-pg img.user-img {
    border-radius: 50%;
    margin-bottom: 25px;
    width: 100px;
    height: 100px;
    border: unset;
    box-shadow: 0px 0px 17px -3px #638e3c;
    margin-right: 25px;
}
.service-selection-btn {
    position: absolute;
    right: 0;
    z-index: 5;
    background: #8ac03d !important;
    border-color: #638e3c !important;
}
.almostdone-pg {
    position: relative;
}
</style>
@endpush
@section('content')
<div class="container mt-5 mb-5 pt-4 almostdone-pg">
<a class="btn btn-primary btn-sm service-selection-btn" href="{{route('frontend.auth.service.selection')}}"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Service Selection</a>
    <div class="row ">
        <div class="col-md-12">
            <div class="user-info">
                @if($auth->avatar_type == 'upload')
                <img class="user-img" src="{{asset($auth->avatar_location)}}">
                @else
                <img class="user-img" src="{{asset('step/assets/images/user.png')}}">
                @endif
                
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
                        @if(getAllProvince())
                            @foreach(getAllProvince() as $province)
                            <option value="{{$province->slug}}" {{ (isset($address) && $auth->province == $province->slug) ? 'selected' : ''}}>{{$province->name}}</option>
                        
                            @endforeach
                        @else
                        @endif
                        <option  value="Alberta" {{ ( $auth->province == 'Alberta') ? 'selected' : ''}}>Alberta</option>
                        
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
