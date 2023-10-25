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
.medication-section .btn:hover {
    background-color: #fff;
    color: #638e3c;
    border-color: #638e3c;
}
.medication-section .btn {
    background-color: #8ac03d;
    border-color: #638e3c;
}
.medication-se .custom-control.custom-checkbox {
    text-align: center;
    padding: 15px 0px;
    box-shadow: 1px 1px 1px 1px #8ac03d;
    border-radius: 6px;
}
.medication-section .order-btn {
    border-radius: 25px;
    margin: 30px 0 12px 0;
    padding: 9px 42px;
    font-size: 22px;
    border: 1px solid;
}
.card__input {
  position: absolute;
  display: block;
  outline: none;
  border: none;
  background: none;
  padding: 0;
  margin: 0;
  -webkit-appearance: none;
}
.card__input:checked ~ .card__body {
  --shadow: 0 0 0 3px var(--card-shadow);
}
.card__input:checked ~ .card__body .card__body-cover-checkbox {
  --check-bg: var(--background-checkbox);
  --check-border: #fff;
  --check-scale: 1;
  --check-opacity: 1;
}
.card__input:checked ~ .card__body .card__body-cover-checkbox--svg {
  --stroke-color: #fff;
  --stroke-dashoffset: 0;
}
.card__input:checked ~ .card__body .card__body-cover:after {
  --opacity-bg: 0;
}
.card__input:checked ~ .card__body .card__body-cover-image {
  --filter-bg: grayscale(0);
}
.card__input:disabled ~ .card__body {
  cursor: not-allowed;
  opacity: 0.5;
}
.card__input:disabled ~ .card__body:active {
  --scale: 1;
}
.card__body {
  display: grid;
  grid-auto-rows: calc(var(--card-height) - var(--header-height)) auto;
  background: var(--background);
  /* height: var(--card-height);
  width: var(--card-width); */
  border-radius: var(--card-radius);
  overflow: hidden;
  position: relative;
  cursor: pointer;
  box-shadow: var(--shadow, 0 4px 4px 0 rgba(0, 0, 0, 0.02));
  transition: transform var(--transition), box-shadow var(--transition);
  transform: scale(var(--scale, 1)) translateZ(0);
  text-align: center;
    align-items: center;
}
.card__body:active {
  --scale: 0.96;
}
.card__body-cover {
  --c-border: var(--card-radius) var(--card-radius) 0 0;
  --c-width: 100%;
  --c-height: 100%;
  position: relative;
  overflow: hidden;
}
.card__body-cover:after {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  width: var(--c-width);
  height: var(--c-height);
  border-radius: var(--c-border);
  background: linear-gradient(to bottom right, var(--background-image));
  mix-blend-mode: var(--blend-mode);
  opacity: var(--opacity-bg, 1);
  transition: opacity var(--transition) linear;
}
.card__body-cover-image {
  width: var(--c-width);
  height: var(--c-height);
  -o-object-fit: cover;
     object-fit: cover;
  border-radius: var(--c-border);
  align-items: center;
    display: flex;
    justify-content: center;
}
.card__body-cover-checkbox {
  background: var(--check-bg, var(--background-checkbox));
  border: 2px solid var(--check-border, #fff);
  position: absolute;
  right: 0px;
  top: 0px;
  z-index: 1;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  opacity: var(--check-opacity, 0);
  transition: transform var(--transition), opacity calc(var(--transition) * 1.2) linear;
  transform: scale(var(--check-scale, 0));
}
.card__body-cover-checkbox--svg {
  width: 13px;
  height: 11px;
  display: inline-block;
  vertical-align: top;
  fill: none;
  margin: 6px 0 0 2px;
  stroke: var(--stroke-color, #fff);
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
  stroke-dasharray: 16px;
  stroke-dashoffset: var(--stroke-dashoffset, 16px);
  transition: stroke-dashoffset 0.4s ease var(--transition);
}
.card {
    --background: #fff;
    --background-checkbox: #8ac03d;
    --background-image: #fff, rgba(0, 107, 175, 0.2);
    --text-color: #666;
    --text-headline: #000;
    --card-shadow: #8ac03d;
    --card-height: 190px;
    --card-width: 190px;
    --card-radius: 12px;
    --header-height: 47px;
    --blend-mode: overlay;
    --transition: 0.15s;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.card:nth-child(odd) .card__body-cover-image {
  --x-y1: 100% 90%;
  --x-y2: 67% 83%;
  --x-y3: 33% 90%;
  --x-y4: 0% 85%;
}
.card:nth-child(even) .card__body-cover-image {
  --x-y1: 100% 85%;
  --x-y2: 73% 93%;
  --x-y3: 25% 85%;
  --x-y4: 0% 90%;
}

.medication-se input, .medication-se select {
    width: unset;
    height: unset;
    border-radius: unset;
    border: unset;
    padding: 12px;
    visibility: hidden;
}

.medication-section label.card {
    padding: 3px !important;
    border-radius: 16px;
}
.details-main {
    float: left;
    text-align: left;
}
</style>
@endpush
@section('content')

<div class="row mt-0 mb-5 prescription-pg">
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
                  @php 
                    //print_r($prescription->medications);
                  @endphp

            @if($prescription->medications)
            <div class="medication-section">
            <div class="order-head mt-5">
              <div class="row">
                <div class="col-md-8">
                    <p class="txt-b mb-0">Medications</p>
                    <small>Choose medications to order</small>
                </div>
              </div>
            </div>
            <div class="order-body mt-3">
            
             <form id="address-form" method='post' action="{{route('frontend.user.order.save')}}" enctype='multipart/form-data'>
              @csrf 
              <div class="row">
              @foreach($prescription->medications as $key => $medication)
                <div class="col-3 mb-2 medication-se">
                  <label class="card">
                      <input class="card__input" name="medication_ids[]" value="{{ $medication->id }}" type="checkbox"/>
                      <div class="card__body">
                        <div class="card__body-cover card__body-cover-image">
                            <span class="card__body-cover-checkbox"> 
                              <svg class="card__body-cover-checkbox--svg" viewBox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                              </svg>
                            </span>
                      
                            <div class="details-main ">
                                <div class="doctor-se">
                                    <span class="title-la">Doctor Name: </span>  <span class="title-he">{{ $medication->prescribing_doctor }}</span> 
                                </div>
                                <div class="drug-se">
                                  <span class="title-la">Drug Name: </span>  <span class="title-he">{{ $medication->drug_name }}</span> 
                                </div>
                                <div class="price">
                                  <span class="title-la subtitle">Price: </span> <span class="title-he"> ${{ $medication->price }} </span>
                                </div>
                            </div>
                        
                          </div>
                      </div>
                    </label>
                </div>
              @endforeach
              </div> <!-- row -->
                <input type="hidden" name="prescription_id" value="{{ $prescription->id }}"/>
              <div class="row">
                <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg order-btn">Create an order</button>
                </div>
              </div><!-- row -->

            </div>
          </form>
          </div>
            @endif

             
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