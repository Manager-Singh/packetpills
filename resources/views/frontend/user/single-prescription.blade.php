@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<style>
.btn-error {
    background: #8ac03d;
    border-radius: 30px;
    text-decoration: none !important;
    color: #fff;
    padding: 3px 10px;
}
.btn-error:hover {
    background-color: #fff;
    color: #8ac03d;
    border: 1px solid #638e3c;
}
.prescription-pg a {
    text-decoration: unset;
    color: #212843;
}
.arrow-back a {
    font-size: 24px;
    border: 1px solid #638e3c;
    color: #638e3c;
    padding: 0px 10px;
    border-radius: 4px;
    transition: 0.7s;
    box-shadow: 0px 0px 6px 0px #638e3c61;
}
.arrow-back {
    margin-top: 1rem;
}
.arrow-back a:hover {
    color: #fff;
    background-color: #8ac03d;
    border-color: #8ac03d;
}
main.main-div {
    margin-top: 0rem;
}
</style>
@endpush
@section('content')

<div class="row mt-0 prescription-pg">
<div class="col-md-1">
  
  </div>
  <div class="col-md-11">
    <div class="arrow-back">
      <a href="{{route('frontend.user.prescription')}}"> <i class="fas fa-arrow-left"></i></a>
    </div>
  </div>
  <div class="col-md-1">
  
  </div>
  <div class="col-md-10">
    <div class="tab-content " id="content">
      <div class="tab-pane fade show active" id="tabs-1" role="tabpanel" aria-labelledby="tab-1">
      
        
            <div class="order">
            
            <div class="order-body">
                      <div class="row">
                        <div class="col-md-4">
                      <p class="txt">Prescription ID </p>
                      <p class="txt-b">{{$prescription->prescription_number}}</p>
                        </div>
                        <div class="col-md-4">
                      <p class="txt">Prescription type</p>
                      <p class="txt-b">{{ (isset($prescription->type)) ? $prescription->type : 'Upload' }}</p>
                        </div>
                        <div class="col-md-4">
                      <p class="txt">Created On</p>
                      <p class="txt-b">{{$prescription->created_at->format('F d, Y ')}}</p>
                        </div>
                      </div>
                  </div>
                  <div class="order-head">
                      <div class="row">
                        <div class="col-md-8">
                            <p class="txt-b">Documents</p>
                        </div>
                        <div class="col-md-4 text-right">
                           
                        </div>
                      </div>
                  </div>
                  <div class="order-body">
                    <div class="row">
                      
                        
                      @foreach ($prescription->prescription_iteams as $iteam)
                      <div class="col-md-3">
                        <div class="image-lightbox"
                            id="lightbox-image">
                            <div class="image-lightbox-wrapper">
                                   <img class="img-responsive" src="{{ asset($iteam->prescription_upload) }}"  alt="">
                                
                            </div>
                        </div>
                        </div>
                      @endforeach
                      
                    </div>
                     
                  </div>
             
            </div>
        
     

        
      </div>
      <div class="tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="tab-2">
        <div class="order">
          <div class="order-head">
            <div class="row">
              <div class="col-md-8">
                <p class="txt">Created On: Aug 7, 2023</p>
              </div>
              <div class="col-md-4 text-right">
                <a class="btn-error" href="#">Cancelled</a>
              </div>
            </div>
          </div>
          <div class="order-body">
            <p class="txt">Prescription ID: 000000</p>
            <p class="txt-b">Transfer requested from MisterPharmacist</p>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="tabs-3" role="tabpanel" aria-labelledby="tab-3">
        <div class="order">
          <div class="order-head">
            <div class="row">
              <div class="col-md-8">
                <p class="txt">Created On: Aug 7, 2023</p>
              </div>
              <div class="col-md-4 text-right">
                <a class="btn-success" href="#">Filled</a>
              </div>
            </div>
          </div>
          <div class="order-body">
            <p class="txt">Prescription ID: 000000</p>
            <p class="txt-b">Transfer requested from MisterPharmacist</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-1"></div>
</div>
@endsection

@push('after-scripts')
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush