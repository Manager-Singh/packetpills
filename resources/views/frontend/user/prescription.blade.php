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
div#accordionExample {
    padding: 3rem 19rem 4rem 3rem;
}
</style>
@endpush
@section('content')
<ul class="nav nav-tabs mb-3 justify-content-end" id="ex1" role="tablist">
  <li class="nav-item" role="presentation">
    <p>Showing: </p>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="tab-1" data-mdb-toggle="tab" href="#all" role="tab" aria-controls="tabs-1" aria-selected="true">All</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="tab-2" data-mdb-toggle="tab" href="#cancelled" role="tab" aria-controls="tabs-2" aria-selected="false">Cancelled</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="tab-3" data-mdb-toggle="tab" href="#filled" role="tab" aria-controls="tabs-3" aria-selected="false">Filled</a>
  </li>
</ul>
<div class="row mt-0  mb-5 prescription-pg">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <div class="tab-content " id="content">
      <div class="tab-pane fade show active" id="tabs-1" role="tabpanel" aria-labelledby="tab-1">
       @if($prescriptions)
        @foreach($prescriptions as $prescription)
        
            <div class="order">
            <a href="{{route('frontend.user.prescription.single',$prescription->prescription_number)}}">
                  <div class="order-head">
                      <div class="row">
                        <div class="col-md-8">
                            <p class="txt">Created On: {{$prescription->created_at->format('F d, Y ')}}</p>
                        </div>
                        <div class="col-md-4 text-right">
                            <span class="btn-error" >{{$prescription->status}}</sapn>
                        </div>
                      </div>
                  </div>
                  <div class="order-body">
                      <p class="txt">Prescription ID: {{$prescription->prescription_number}}</p>
                      <p class="txt-b">Prescription Uploaded</p>
                  </div>
              </a>
             @if($prescription && isset($prescription->medications) && $prescription->medications->count() > 0) 
              <div class="order-head">
                  <div class="row">
                    <div class="col-md-8">
                        <p class="txt">Added Medications</p>
                    </div>
                   
                  </div>
              </div>
              <div class="accordion" id="accordionExample">

              @foreach($prescription->medications as $medication)

            <div class="card">
              <h2 class="card-header" id="headingOne">
                <button class="accordion-button" type="button" data-toggle="collapse" data-target="#collapseOne_{{$medication->id}}" aria-expanded="true" aria-controls="collapseOne_{{$medication->id}}">
                  <!-- Proctodan-hc Oint   -->
                  {{ $medication->pharmacy }}
                </button>
               
              </h2>
              <div id="collapseOne_{{$medication->id}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  <table>
                    <!-- <tr>
                      <td>Automatically refill this medication?</td>
                      <td class="text-right">
                        <label class="switch">
                          <input class="switch-input" type="checkbox" />
                          <span class="switch-label" data-on="Yes" data-off="No"></span> 
                          <span class="switch-handle"></span> 
                        </label>
                      </td>
                    </tr> -->
                    <tr><td>Prescribing doctor</td><td class="text-right"> {{ $medication->prescribing_doctor }}</td></tr>
                    <tr><td>Quantity left</td><td class="text-right">{{ $medication->qty_left }}</td></tr>
                    <tr><td>Quantity filled</td><td class="text-right">{{ $medication->qty_filled }}</td></tr>
                    <!-- <tr><td>Pocketpacks</td><td class="text-right">No</td></tr> -->
                    </table>
                </div>
              </div>
            </div>
            @endforeach

           
          </div><!-- accordion-->
          @endif
        </div>
        
        @endforeach
       @else
       @endif 

        
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