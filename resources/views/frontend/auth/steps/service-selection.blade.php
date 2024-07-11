@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<style>
.modal-header {
    display: block !important;
    text-align: center;
    position: relative;
    color: #212843;
    background: #fff;
}
.on-top {
    position: relative;
    /* margin-top: -65px; */
}
div#pharmaModal {
    background: #0006;
}
.modal-dialog {
    margin-top: 65px;
}
.modal-body .icon {
    font-size: 22px;
    margin-right: 25px;
}
.modal-body .card {
    border-bottom: 1px solid #ccc !important;
    border: none;
    border-radius: 0;
    margin: 0px !important;
    padding: 10px !important;
}
.modal-footer {
    border: 0;
}
button.btn.btn-secondary {
    width: 100%;
    height: 54px;
    font-size: 20px;
    background: transparent;
    color: #212843;
    border-color: #212843;
}

.more-btn-o a {
    padding: 10px 15px 10px 15px;
    background-color: #638e3c61;
    border-radius: 40px;
    color: #000;
    text-decoration: unset;
}
.bnner-mg-pres {
    text-align: center;
}
.bnner-mg-pres img {
    width: 68%;
    margin-bottom: 20px;
}

.service-se .card-body {
    height: 300px;
}
/* .prescription-upload-se .card {
    box-shadow: rgba(0, 0, 0, 0.35) 0 0 15px;
    border: 1px solid #9ae2ff;
    animation-name: blinking;
    animation-duration: 1s;
    animation-iteration-count: 100;
} */

.prescription-upload-se .card  {
  
  background: rgba(25, 118, 210, 0.4);
  animation: blink 1s ease-in-out infinite none;
}
.prescription-upload-se .card-body {
    background: #638e3c;
}
@keyframes blink {
  0% {
    box-shadow: 0 0 0 0 rgb(99 142 60);
  }
  100% {
    box-shadow: 0 0 0 6px rgb(99 142 60 / 30%);
  }
}

</style>
@endpush
@section('content')
<div class="container mt-0 mb-5 pt-0">
		    	<div class="row ">
				    <div class="col-md-12">
              <div class="user-info">
                <!-- <img class="user-img" src="{{asset('step/assets/images/user.png')}}"> -->
                <img class="user-img" src="{{asset('website/assets/images/logo.gif')}}">
                <h3 class="txt mb-0">Welcome To <br> MisterPharmacist</h3>
                <!-- <p class="txt mb-0">Welcome To</p>
                <p class="txt mb-0 mt-0">MisterPharmacist</p> -->
                <!-- <p class="txt mt-0">MisterPharmacist</p> -->
              </div> 

				    </div>
				    <div class="col-md-12 mt-3">
                        <div class="row service-se">
                        <div class="col-md-4">

              <div class="card blue border-light text-left p-1 mb-4">
                @if(Auth::check() && Auth::user()->is_profile_status == "completed")
                <a href="{{route('frontend.user.search.pharma')}}">
                @else
                <a href="{{route('frontend.user.dashboard')}}">
                @endif
                
                  <div class="card-body">
                      <div class="d-flex px-1 px-md-3">
                          <div>
                              <div class="icon icon-primary"><i class="fa fa-recycle" aria-hidden="true"></i></div>
                          </div>
                          <div class="pl-2 pl-md-3">
                              <h5>Already taking medications?</h5>
                              <p>We'll transfer the prescriptions from your current pharmacy and deliver them to you.</p>
                           
                          </div>
                      </div>
                  </div>
                  </a>
                </div>
</div>
<div class="col-md-4 prescription-upload-se">
                 <div class="card red border-light text-left p-1 mb-4">
                 @if(Auth::check() && Auth::user()->is_profile_status == "completed")
                 <a href="{{route('frontend.user.prescription.upload')}}">
                @else
                <a href="{{route('frontend.user.prescription.upload')}}">
                <!-- <a href="{{route('frontend.user.dashboard')}}"> -->
                @endif
                    
                  <div class="card-body">
                      <div class="d-flex px-1 px-md-3">
                          <div>
                              <div class="icon icon-primary"><i class="fa fa-camera" aria-hidden="true"></i></div>
                          </div>
                          <div class="pl-2 pl-md-3">
                              <h5>Have a new prescription to fill?</h5>
                              <p>Upload the picture and we'll deliver your medication.</p>
                              
                          </div>
                      </div>
                  </div>
                  </a>
                </div>
</div>
<div class="col-md-4">
                 <div class="card green border-light text-left p-1 mb-4">
                    <a href="{{route('frontend.auth.step.telehealth')}}">
                    <div class="card-body">
                        <div class="d-flex px-1 px-md-3">
                            <div>
                                <div class="icon icon-primary"><i class="fa fa-phone" aria-hidden="true"></i></span></div>
                            </div>
                            <div class="pl-2 pl-md-3">
                                <h5>Need a prescription? </h5>
                                <p>Visit our Minor Ailments Page to see if you qualify for a minor ailment prescription or ask your doctor to fax a prescription to us at <br><b>416-593-4166</b></p>
                                
                            </div>
                        </div>
                    </div>
                  </a>
</div>
</div>
</div>
<div class="row">
    <div class="col-md-12 bnner-mg-pres"><a href="{{route('frontend.user.prescription.upload')}}"><img src="{{asset('img/banner-prescription.jpg')}}"/></a></div>
</div>                
<div class=" text-center p-1 more-btn-o">
                    
                    
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#pharmaModal">More options</a>
                    
                </div>
 
				</div>
			</div>
		</div>

    <!-- Modal -->
    <div class="modal fade" id="pharmaModal" tabindex="-1" role="dialog" aria-labelledby="pharmaModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="on-top">
              <img class="user-img" src="{{asset('website/assets/images/logo.gif')}}">
              <h5 class="modal-title" id="pharmaModalLabel">Welcome To MisterPharmacist</h5>
              <h4 class="modal-title " id="pharmaModalLabel">How can we Help?</h4>
            </div>
            
          </div>
          <div class="modal-body">
            <div class="card text-left p-1 mb-4">
             
              @if(Auth::check() && Auth::user()->is_profile_status == "completed")
              <!-- <a href="{{route('frontend.drug.search')}}"> -->
                 <a href="#">

                @else
                <!-- <a href="{{route('frontend.user.dashboard')}}"> -->
                <a href="#">
                @endif
                <div class="card-b">
                    <div class="d-flex px-1 px-md-3">
                        <div>
                            <div class="icon"><i class="fa fa-search" aria-hidden="true"></i></div>
                        </div>
                        <div class="pl-2 pl-md-3">
                            <h5>Search for medication prices (Coming Soon)</h5>
                            
                         
                        </div>
                    </div>
                </div>
                </a>
              </div>
              <div class="card text-left p-1 mb-4">
                <a href="#">
                  <div class="card-b">
                      <div class="d-flex px-1 px-md-3">
                          <div>
                              <div class="icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                          </div>
                          <div class="pl-2 pl-md-3">
                              <h5>See how it work (Coming Soon)</h5>
                              
                           
                          </div>
                      </div>
                  </div>
                  </a>
                </div>
                <!-- <div class="card text-left p-1 mb-4">
                  <a href="{{route('frontend.auth.step.personal')}}">
                    <div class="card-b">
                        <div class="d-flex px-1 px-md-3">
                            <div>
                                <div class="icon"><i class="fa fa-user-plus" aria-hidden="true"></i></div>
                            </div>
                            <div class="pl-2 pl-md-3">
                                <h5>Sign up to add others</h5>
                                
                             
                            </div>
                        </div>
                    </div>
                    </a>
                  </div> -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 
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
