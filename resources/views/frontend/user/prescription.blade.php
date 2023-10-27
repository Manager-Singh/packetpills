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
    padding: 3rem 3rem 3rem 3rem;
}

div#accordionExample tr td {
    padding: 0;
    font-size: 14px;
}
div#accordionExample .card-body {
    background: #fff;
    padding: 4px 10px 0px 10px;
}
div#accordionExample {
    padding: 20px 50px;
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
              <div class="accordion row" id="accordionExample">

              @foreach($prescription->medications as $medication)

            <div class="card col-md-3">
              <div id="collapseOne_{{$medication->id}}" class="accordion-collapse"  >
                <div class="card-body">
                  <table>
                    
                    <tr>
                      <td> Drug Name</td>
                      <td class="text-right"> {{ $medication->drug_name }}</td>
                    </tr>
                    <tr>
                      <td> Doctor Name</td>
                      <td class="text-right"> {{ $medication->prescribing_doctor }}</td>
                    </tr>
                    <tr>
                      <td> Price</td>
                      <td class="text-right"> ${{ $medication->price }}</td>
                    </tr>
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