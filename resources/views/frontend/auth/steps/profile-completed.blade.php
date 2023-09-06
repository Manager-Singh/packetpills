@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mt-5 mb-5 pt-5">
    <div class="row ">
        <div class="col-md-12">
            <div class="user-info">
                <img class="user-img" src="{{asset('step/assets/images/user.png')}}">
                <p class="bold-txt">Add members to MisterPharmacist</p>
                <p class="txt">Welcome latest design trends Designed with the latest design trendsDesigned with the
                    latest design trends </p>
            </div>

        </div>

        <div class="col-md-12 mt-4">
            <div class="row">
                <div class="col-md-4">

            <div class="card border-light text-left p-1 mb-4">
                <div class="card-body">
                    <div class="d-flex px-1 px-md-3">
                        <div>
                            <div class="icon icon-primary"><i class="fa fa-users" aria-hidden="true"></i></div>
                        </div>
                        <div class="pl-2 pl-md-3">
                            <h5>Add family member</h5>
                            <p>Designed with the latest design trends in mind. Our product feels modern, creative.</p>

                        </div>
                    </div>
                </div>
            </div>
</div>
<div class="col-md-4">
            <div class="card border-light text-left p-1 mb-4">
                <div class="card-body">
                    <div class="d-flex px-1 px-md-3">
                        <div>
                            <div class="icon icon-primary"><i class="fa fa-truck" aria-hidden="true"></i></div>
                        </div>
                        <div class="pl-2 pl-md-3">
                            <h5>Complete your profile</h5>
                            <p>Designed with the latest design trends in mind.</p>

                        </div>
                    </div>
                </div>
            </div>
</div>

<div class="col-md-4">
    <div class="card border-light text-left p-1 mb-4">
                <a href="{{route('frontend.user.dashboard')}}">
                    <div class="card-body">
                        <div class="d-flex px-1 px-md-3">
                            <div>
                                <div class="icon icon-primary"><i class="fa fa-th-large" aria-hidden="true"></i></div>
                            </div>
                            <div class="pl-2 pl-md-3">
                                <h5>Explore the dashboard</h5>
                                <p>Designed with the latest design trends in mind. Our product feels modern, creative.</p>

                            </div>
                        </div>
                    </div>
                </a>

            </div>
</div>
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