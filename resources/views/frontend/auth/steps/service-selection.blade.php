@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<style>
.modal-header {
    display: block !important;
    text-align: center;
    position: relative;
    background: #212843;
    color: #fff;
}
.on-top {
    position: relative;
    margin-top: -65px;
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

</style>
@endpush
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
                <a href="{{route('frontend.auth.step.transfer')}}">
                  <div class="card-body">
                      <div class="d-flex px-1 px-md-3">
                          <div>
                              <div class="icon icon-primary"><i class="fa fa-recycle" aria-hidden="true"></i></div>
                          </div>
                          <div class="pl-2 pl-md-3">
                              <h5>Already taking medications?</h5>
                              <p>We'll transfer prescriptions from your current pharmacy and deliver them to you.</p>
                           
                          </div>
                      </div>
                  </div>
                  </a>
                </div>
                 <div class="card border-light text-left p-1 mb-4">
                    <a href="{{route('frontend.auth.step.prescription')}}">
                  <div class="card-body">
                      <div class="d-flex px-1 px-md-3">
                          <div>
                              <div class="icon icon-primary"><i class="fa fa-camera" aria-hidden="true"></i></div>
                          </div>
                          <div class="pl-2 pl-md-3">
                              <h5>Have a new prescription to fill?</h5>
                              <p>Upload a picture and we'll deliver your medication.</p>
                              
                          </div>
                      </div>
                  </div>
                  </a>
                </div>
                 <div class="card border-light text-left p-1 mb-4">
                    <a href="{{route('frontend.auth.step.telehealth')}}">
                    <div class="card-body">
                        <div class="d-flex px-1 px-md-3">
                            <div>
                                <div class="icon icon-primary"><i class="fa fa-phone" aria-hidden="true"></i></span></div>
                            </div>
                            <div class="pl-2 pl-md-3">
                                <h5>Need a prescription? </h5>
                                <p>Explore options to see a doctor online; or get your doctor to send us your prescription.</p>
                                
                            </div>
                        </div>
                    </div>
                  </a>
                </div>
                <div class=" text-center p-1 ">
                    
                    
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
              <img class="user-img" src="{{asset('step/assets/images/user.png')}}">
              <h5 class="modal-title" id="pharmaModalLabel">Welcome latest design trends</h5>
              <h4 class="modal-title " id="pharmaModalLabel">How can we Help?</h4>
            </div>
            
          </div>
          <div class="modal-body">
            <div class="card text-left p-1 mb-4">
              <a href="#">
                <div class="card-b">
                    <div class="d-flex px-1 px-md-3">
                        <div>
                            <div class="icon"><i class="fa fa-search" aria-hidden="true"></i></div>
                        </div>
                        <div class="pl-2 pl-md-3">
                            <h5>Search for medication prices</h5>
                            <p>Designed with the latest design trends in mind.</p>
                         
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
                              <h5>See how it work</h5>
                              <p>Designed with the latest design trends in mind.</p>
                           
                          </div>
                      </div>
                  </div>
                  </a>
                </div>
                <div class="card text-left p-1 mb-4">
                  <a href="{{route('frontend.auth.step.personal')}}">
                    <div class="card-b">
                        <div class="d-flex px-1 px-md-3">
                            <div>
                                <div class="icon"><i class="fa fa-user-plus" aria-hidden="true"></i></div>
                            </div>
                            <div class="pl-2 pl-md-3">
                                <h5>Sign up to add others</h5>
                                <p>Designed with the latest design trends in mind.</p>
                             
                            </div>
                        </div>
                    </div>
                    </a>
                  </div>
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
