@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mb-5 mt-5">
    <div class="row bg-light">
        <div class="col-md-8">
            <div class="med-info">
                <p class="txt"><strong>Order page</strong></p>
                <p class="txt">Welcome latest design trends Designed </p>

            </div>
        </div>
        <div class="col-md-4 text-end">
            <a href="#" class="info-btn">Request Refill</a>

        </div>
    </div>

    <p class="bold-txt mt-5">What would you like to do?</p>


</div>
@endsection

@push('after-scripts')
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush