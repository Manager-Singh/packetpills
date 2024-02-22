@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<style>
.profile-com-pg img.user-img {
    border-radius: 50%;
    margin-bottom: 25px;
    width: 100px;
    height: 100px;
    border: unset;
    box-shadow: 0px 0px 17px -3px #638e3c;
    margin-right: 25px;
}
.profile-com-pg .row .card {
    box-shadow: 0px 0px 6px 0px #638e3c57 !important;
    height: 231px;
}
.profile-com-pg .row .card h5 {
    font-size: 22px;
}
.profile-com-pg .row .card p {
    font-size: 16px;
}
.profile-com-pg .row .card:hover .card-body {
    background-color: #8ac03d;
    color: #fff;
}
.profile-com-pg .row .card:hover p, .profile-com-pg .row .card:hover h5 {
    color: #fff;
}
.profile-com-pg .row .card i.fa {
    transition: 0.9s;
    transform: rotateY(360deg);
}
.profile-com-pg .row .card:hover i.fa {
    
    transition: 0.9s;
    transform: rotateY(180deg);
}
</style>
@endpush
@section('content')
<div class="container mt-0 mb-5 pt-1 profile-com-pg">
    <div class="row ">
        <div class="col-md-12">
            <div class="user-info">
                <!-- <img class="user-img" src="{{asset('step/assets/images/user.png')}}"> -->
                @if($auth->avatar_type == 'upload')
                <img class="user-img" src="{{asset($auth->avatar_location)}}">
                @else
                <img class="user-img" src="{{asset('step/assets/images/user.png')}}">
                @endif
                <!-- <p class="bold-txt">Add members to MisterPharmacist</p> -->
                <!-- <p class="txt"> Your profile has been completed. </p> -->
            </div>

        </div>

        <div class="col-md-12 mt-4">
            <div class="row">
                <div class="col-md-3">

                    <div class="card border-light text-left p-1 mb-4 add-member-tab">
                        
                        <div class="card-body">
                            <a href="{{route('frontend.user.add.member')}}">
                                <div class="text-center px-1 px-md-3">
                                    <div>
                                        <div class="icon icon-primary"><i class="fi fi-br-person-circle-plus fa"></i></div>
                                    </div>
                                    <div class="pl-2 pl-md-3 pt-3">
                                        <h5>Add family member</h5>
                                        <p>Add your family member to create profile.</p>

                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-light text-left p-1 mb-4 complete-profile-tab">
                        <div class="card-body">
                        <a href="{{route('frontend.user.personal.details')}}">
                                <div class="text-center px-1 px-md-3">
                                    <div>
                                        <div class="icon icon-primary"><i class="fi fi-br-file-user fa"></i></div>
                                    </div>
                                    <div class="pl-2 pl-md-3 pt-3">
                                        <h5>Complete your profile</h5>
                                        <p>Complete you profile to add prescription.</p>

                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-light text-left p-1 mb-4 dashboard-tab">
                    
                        <div class="card-body">
                            <a href="{{route('frontend.user.dashboard')}}">
                                <div class="text-center px-1 px-md-3">
                                    <div>
                                        <div class="icon icon-primary"><i class="fi fi-br-dashboard fa"></i></div>
                                    </div>
                                    <div class="pl-2 pl-md-3 pt-3">
                                        <h5>Explore the dashboard</h5>
                                        <p>Visit your dashboard.</p>

                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-light text-left p-1 mb-4 dashboard-tab">
                    
                        <div class="card-body">
                            <a href="{{route('frontend.user.search.pharma')}}">
                                <div class="text-center px-1 px-md-3">
                                    <div>
                                        <div class="icon icon-primary"><i class="fi fi-br-nfc-pen fa"></i></div>
                                    </div>
                                    <div class="pl-2 pl-md-3 pt-3">
                                        <h5>Transfer Request</h5>
                                        <p>Search and select your current pharmacy</p>

                                    </div>
                                </div>
                            </a>
                        </div>
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