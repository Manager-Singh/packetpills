@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mt-5 mb-5 pt-5">
    <div class="row ">
        <div class="col-md-6">
            <div class="user-info">
                <img class="user-img" src="{{asset('step/assets/images/user.png')}}">
                <p class="txt">Designed with the latest design trends</p>
                <p class="txt">Welcome latest design trends</p>
                <p class="bold-txt">Designed with the latest design trends</p>
            </div>

        </div>
        <div class="col-md-6">

            <div class="card border-light text-left p-1 mb-4">
                <a href="#">
                    <div class="card-body">
                    telehealth
                    </div>
                </a>
            </div>
            
           

        </div>
    </div>
</div>
@endsection

@push('after-scripts')
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush