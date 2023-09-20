@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mt-5 mb-5 pt-5">
    <div class="row ">
        <div class="col-md-12">
            <div class="user-info">
                <img class="user-img" src="{{asset('step/assets/images/user.png')}}">
                <p class="txt">Designed with the latest design trends</p>
                <p class="txt">Welcome latest design trends Designed with the latest design trendsDesigned with the
                    latest design trends </p>
            </div>

        </div>
        <div class="col-md-2">
</div>

        <div class="col-md-8">

            <form name="myForm" action="{{route('frontend.auth.step.create.password.save')}}" method="post">
                <div class="row">
                @csrf
                    <div class="col-md-12 verify">
                        <label for="lname">Choose a Password</label>
                        <input type="password" id="password" name="password" placeholder="" />
                        <p class="reshare"> <a href="">Show</a></p>
                        <p class="info">Please enter 8 or more characters</p>
                    </div>
                    <div class="col-md-12 verify">
                        <label for="lname">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="" />
                        <p class="reshare"> <a href="">Show</a></p>
                        <p class="info">Please enter 8 or more characters</p>
                        <p class="info"><span id='message'></span></p>
                    </div>
                </div>
                <button type="submit" class="next button submit-passowrd">Next</button>

            </form>


        </div>
        <div class="col-md-2">
</div>

    </div>
</div>
@endsection

@push('after-scripts')
<script>
    $('#password, #confirm_password').on('keyup', function () {
        
        if ($('#password').val() == $('#confirm_password').val()) {
            $('.submit-passowrd').prop('disabled', false);
            $('#message').html('Matching').css('color', 'green');
        } else {
            $('.submit-passowrd').prop('disabled', true);
            $('#message').html('Not Matching').css('color', 'red');

        }
    });
</script>

@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush