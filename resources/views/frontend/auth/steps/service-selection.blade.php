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
                      <div class="d-flex px-1 px-md-3">
                          <div>
                              <div class="icon icon-primary"><i class="fa fa-recycle" aria-hidden="true"></i></div>
                          </div>
                          <div class="pl-2 pl-md-3">
                              <h5>100% Satisfaction</h5>
                              <p>Designed with the latest design trends in mind. Our product feels modern, creative, and beautiful.</p>
                           
                          </div>
                      </div>
                  </div>
                  </a>
                </div>
                 <div class="card border-light text-left p-1 mb-4">
                    <a href="#">
                  <div class="card-body">
                      <div class="d-flex px-1 px-md-3">
                          <div>
                              <div class="icon icon-primary"><i class="fa fa-camera" aria-hidden="true"></i></div>
                          </div>
                          <div class="pl-2 pl-md-3">
                              <h5>100% Satisfaction</h5>
                              <p>Designed with the latest design trends in mind.</p>
                              
                          </div>
                      </div>
                  </div>
                  </a>
                </div>
                 <div class="card border-light text-left p-1 mb-4">
                    <a href="#">
                  <div class="card-body">
                      <div class="d-flex px-1 px-md-3">
                          <div>
                              <div class="icon icon-primary"><i class="fa fa-phone" aria-hidden="true"></i></span></div>
                          </div>
                          <div class="pl-2 pl-md-3">
                              <h5>100% Satisfaction</h5>
                              <p>Designed with the latest design trends in mind. Our product feels modern, creative, and beautiful.</p>
                             
                          </div>
                      </div>
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
