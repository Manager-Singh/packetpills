@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<style>
  .alert-main {
    position: fixed;
    background-color: rgb(33 40 67 / 25%);
    top: 0;
    bottom: 0;
    right: 0;
    opacity: 1;
    width: 100%;
    z-index: 10;
    justify-content: center;
    align-items: center;
    display: flex;
}
.alert-main .alert {
    z-index: 1000;
    position: absolute;
    width: 50%;
}
.alert-main button.close:after{
    all:unset;
}
.message-alert {
    margin: 3rem !important;
    text-align: center;
    font-size: 16px;
}
 </style>
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
.gallery img {
    width: 100%;
    height: 200px;
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
  --shadow: 0 0 0 0px var(--card-shadow);
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
<ul class="nav nav-tabs mb-3 justify-content-end" id="ex1" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active"  href="{{route('frontend.user.prescription.upload')}}">Add Prescription</a>
  </li>
  <li class="nav-item" role="presentation">
    <p>Showing: </p>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="tab-1" data-mdb-toggle="tab" href="#all" role="tab" aria-controls="tabs-1" aria-selected="true">All</a>
  </li>
  <!-- <li class="nav-item" role="presentation">
    <a class="nav-link" id="tab-2" data-mdb-toggle="tab" href="#cancelled" role="tab" aria-controls="tabs-2" aria-selected="false">Cancelled</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="tab-3" data-mdb-toggle="tab" href="#filled" role="tab" aria-controls="tabs-3" aria-selected="false">Filled</a>
  </li> -->
</ul>
<div class="row mt-0  mb-5 prescription-pg">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <div class="tab-content hhh " id="content">
      <div class="tab-pane fade show active kkkkkkk" id="tabs-1" role="tabpanel" aria-labelledby="tab-1">
       @if($prescriptions->isNotEmpty())
        @foreach($prescriptions as $prescription)


@php
if ($prescription->status == 'pending'){
  $status_class = "badge-warning";
}elseif($prescription->status == 'cancelled'){
  $status_class = "badge-danger";
}elseif($prescription->status == 'approved'){
  $status_class = "badge-success";
}else{
  $status_class = "btn-error";
}

@endphp
        
          <div class="order">
            <a href="{{route('frontend.user.prescription.single',$prescription->prescription_number)}}">
                  <div class="order-head">
                      <div class="row">
                        <div class="col-md-8">
                            <p class="txt">Created On: {{$prescription->created_at->format('F d, Y ')}}</p>
                        </div>
                        <div class="col-md-4 text-right">
                            <span class="{{$status_class}}" style="border-radius: 14px;padding: 3px 9px;">{{ucfirst($prescription->status)}}</span>
                            <span class="bg-danger btn-error" onclick="prescritpionDelted('{{$prescription->id}}')">Delete</span>
                        </div>
                        
                      </div>
                  </div>
                  <div class="order-body row">
                    <div class="col-md-6">
                      <p class="txt">Prescription Online ID: {{$prescription->prescription_number}}</p>
                      <p class="txt-b">Prescription Uploaded</p>
                    </div>
                    <div class="col-md-12">

                    
                      
                      <!-- Gallery Section -->
                      <div class="gallery row">
    @foreach($prescription->prescription_iteams as $iteam => $prescription_iteam)
        <div class="col-md-3">
            <a href="#" data-toggle="modal" data-target="#imageModal{{ $prescription_iteam->prescripiton_id }}-{{ $prescription_iteam->page_no }}">
                @if(Str::lower(pathinfo($prescription_iteam->prescription_upload, PATHINFO_EXTENSION)) === 'pdf')
                    <img src="{{ asset('img/pdf.png') }}" alt="{{ $prescription_iteam->page_no }}" />
                @else
                    <img src="{{ asset($prescription_iteam->prescription_upload) }}" alt="{{ $prescription_iteam->page_no }}" />
                @endif
            </a>
            <div class="image-title text-center"><b>Prescription page No. {{ $prescription_iteam->page_no }}</b></div>

            <div class="modal fade" id="imageModal{{ $prescription_iteam->prescripiton_id }}-{{ $prescription_iteam->page_no }}" tabindex="-1" role="dialog" aria-labelledby="imageModal{{ $prescription_iteam->prescripiton_id }}-{{ $prescription_iteam->page_no }}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModal{{ $prescription_iteam->prescripiton_id }}-{{ $prescription_iteam->page_no }}Label">Prescription page No.{{ $prescription_iteam->page_no }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            @if(Str::lower(pathinfo($prescription_iteam->prescription_upload, PATHINFO_EXTENSION)) === 'pdf')
                                <iframe src="{{ asset($prescription_iteam->prescription_upload) }}" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                            @else
                                <img src="{{ asset($prescription_iteam->prescription_upload) }}" alt="{{ $prescription_iteam->page_no }}" class="img-fluid">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>


                    
                                

                    </div>
                  </div>
              </a>
             @if($prescription && isset($prescription->medications) && $prescription->medications->count() > 0) 
            <div class="order-head">
                  <div class="row">
                    <div class="col-md-8">
                        <div class="form-group form-check">
                          <input type="checkbox" class="form-check-input askForRefill" id="{{$prescription->id}}">
                          <label class="form-check-label" for="{{$prescription->id}}">Ask for a refill</label>
                        </div>
                    </div>
                   
                  </div>
              </div>
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
@php 
$prescription_refills = getPrescriptionRefill($prescription->id);
@endphp 
          
      @if($prescription_refills->isNotEmpty())
          <div class="order-head">
            <div class="row">
              <div class="col-md-12">
                  <p class="txt">Prescription Refills Requests</p>
              </div>
            </div>
          </div>
@endif

          <div class="accordion row" id="accordionExample">

            @foreach($prescription_refills as $prescription_refill)

           

            <div class="card col-md-6 mb-3">
            <div id="collapseOne_{{$medication->id}}" class="accordion-collapse"  >
              <div class="card-body">
                <table>
                  
                <tr>
                    <td> Refill Date</td>
                    <td class="text-right"> {{ $prescription_refill->created_at->format('Y-m-d') }}</td>
                  </tr>
                  <tr>
                    <td> Refill Time</td>
                    <td class="text-right"> {{ $prescription_refill->created_at->format('H:i:s') }}</td>
                  </tr>
                  <tr>
                    <td> Patient Name:</td>
                    <td class="text-right"> {{ $prescription_refill->user->full_name }}</td>
                  </tr>
                  <tr>
                    <td> Medication</td>
                    <td class="text-right"> @if(isset($prescription_refill->prescription->medications))
                                    @foreach($prescription_refill->prescription->medications as $medication)
                                       <!-- {{$medication->drug_name }}  , -->
                                    @endforeach
                                @endif
                                {{isset($prescription_refill->medication->drug_name) ? $prescription_refill->medication->drug_name : ''}} 
                              </td>
                  </tr>

@php
if ($prescription_refill->status == 'pending'){
  $status_class = "badge-warning";
}elseif($prescription_refill->status == 'cancelled'){
  $status_class = "badge-danger";
}elseif($prescription_refill->status == 'approved'){
  $status_class = "badge-success";
}elseif($prescription_refill->status == 'We need to contact doctor'){
  $status_class = "badge-warning";
}elseif($prescription_refill->status == 'processing'){
  $status_class = "badge-warning";
}elseif($prescription_refill->status == 'declined'){
  $status_class = "badge-danger";
}else{
  $status_class = "";
}

@endphp




                  <tr>
                    <td> <b class="font-weight-bold">Status</b></td>
                    <td class="text-right"> <b class="{{$status_class}}" style="border-radius: 6px;padding: 0px 5px 1px 5px;">{{ ucfirst($prescription_refill->status) }}<b></td>
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
        <div class="order">
          <div class="order-head">
            <p class="txt text-center">No Prescription found!</p>
          </div>
        </div>
       @endif
        <div class="order">
          <div class="order-head">
            <p class="txt">Existing MisterPharmacist Patients: Enter Your Prescription(s) Details For A Refill Request</p>
          </div>
          <div class="order-body existing-pres">
            <form method='post' action="{{route('frontend.user.prescription.old.save')}}" enctype='multipart/form-data'>
              @csrf 
              <div class="row main-idv" bis_skin_checked="1">
                <div class="col-sm-4 nopadding" bis_skin_checked="1">
                  <div class="form-group" bis_skin_checked="1">
                    <label for="prescription_number">MisterPharmacist Prescription label Number R#</label>
                    <input type="text" class="form-control" id="prescription_number" name="prescription_number[]" value="" placeholder="Rx#" required="">
                  </div>
                </div>
                <div class="col-sm-4 nopadding" bis_skin_checked="1">
                  <div class="form-group" bis_skin_checked="1">
                      <label for="prescription_img">Prescription Label Image (Optional)</label>
                      <input type="file" class="form-control" id="prescription_img" name="prescription_img[]" value="" placeholder="Prescription Image">
                  </div>
                </div>
                <div class="col-sm-4 nopadding" bis_skin_checked="1">
                  <div class="form-group" bis_skin_checked="1">
                    <div class="input-group align-items-end" bis_skin_checked="1">
                      <div class="rmedication-name">
                        <label for="medication_name">Medication Name</label>
                        <input type="text" class="form-control" name="medication_name[]" value="" placeholder="Medication Name" required="" min="1" tep="1">
                      </div>
                      <div class="input-group-btn ml-2" bis_skin_checked="1">
                        <button class="btn btn-success" type="button" onclick="add_prescription_field()">
                          <span class="fa fa-plus" aria-hidden="true"></span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="clear" bis_skin_checked="1"></div>
              </div>
              <div class="append-html"></div>
              <div class="col-md-3">

                  <button type="submit"class="next button submit" onclick="" >Submit</button>
              </div>
            </form>
            <!-- <div class="row child-idv" bis_skin_checked="1">
              <div class="col-sm-3 nopadding" bis_skin_checked="1">
                <div class="form-group" bis_skin_checked="1">
                  <input type="text" class="form-control" name="prescription_number" value="" placeholder="Prescription Number" required="">
                </div>
              </div>
              <div class="col-sm-3 nopadding" bis_skin_checked="1">
                <div class="form-group" bis_skin_checked="1">
                    <input type="file" class="form-control" name="prescription_img" value="" placeholder="Prescription Image" required="">
                </div>
              </div>
              <div class="col-sm-3 nopadding" bis_skin_checked="1">
                <div class="form-group" bis_skin_checked="1">
                  <div class="input-group align-items-center" bis_skin_checked="1">
                    <input type="text" class="form-control" name="medication_name" value="" placeholder="Medication Name" required="" min="1" tep="1">
                    <div class="input-group-btn ml-2" bis_skin_checked="1">
                      <button class="btn btn-success remove_prescription_field1" type="button" onclick="remove_prescription_field()">
                        <span class="fa fa-minus" aria-hidden="true"></span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clear" bis_skin_checked="1"></div>
            </div> -->

          </div>
        </div>
       <!-- end added prescription --> 

        @if($prescriptions_old->isNotEmpty())

        
        <div class="order">
        <div class="order-head">
          <p class="txt">Existing prescriptions refill requests</p>
          </div>
          <div class="order-body table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Prescription no.</th>
                  <th scope="col">Uploaded Image</th>
                  <th scope="col">Medication Name</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
              @foreach($prescriptions_old as $prescription_old)

              @php
if ($prescription_old->status == 'pending'){
  $status_class = "badge-warning";
}elseif($prescription_old->status == 'cancelled'){
  $status_class = "badge-danger";
}elseif($prescription_old->status == 'approved'){
  $status_class = "badge-success";
}elseif($prescription_old->status == 'active'){
  $status_class = "badge-success";
}else{
  $status_class = "";
}

@endphp

                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{$prescription_old->prescription_number}}</td>
                  <td>
                    @if(isset($prescription_old->image) && !empty($prescription_old->image))
                      <img  width="100" height="100" src="{{asset($prescription_old->image)}}" />
                    @else
                      No Image
                    @endif
                    
                  </td>
                  <td>{{$prescription_old->medication_name}}</td>
                  <td><span class="{{$status_class}}" style="border-radius: 6px;padding: 0px 5px 1px 5px;">{{ucfirst($prescription_old->status)}}</span></td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
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
            <p class="txt">Prescription Online ID: 000000</p>
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
            <p class="txt">Prescription Online ID: 000000</p>
            <p class="txt-b">Transfer requested from MisterPharmacist</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-1"></div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="ask-for-refill" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ask for a refill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body medication-section">
       <div class="col-md-12">
       <p class="txt-b mb-0">Medications</p>
      <small>Choose medications to Refill</small>
       </div>
       <div class="col-md-12">
       <form id="address-form" method='post' action="{{route('frontend.user.prescription.refill')}}" enctype='multipart/form-data'>
        

        </form>
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
<script>

function remove_prescription_field(){
  //$(".removeclass" + rid).remove();
}
$('.append-html').on('click','.remove_prescription_field',function(){

  $(".loader-container").show();

 console.log('ghjk');
 console.log($(this).parent());
 console.log($(this).closest('.child-idv'));
 console.log($(this).parent().closest('.child-idv'));
 
 $(this).parent().closest('.child-idv').remove();

  setTimeout(function() {
          // Hide the loader after the form is submitted
          
          $(".loader-container").hide();
        }, 300); // 2000 milliseconds (2 seconds) is an example, adjust as needed

})

function add_prescription_field(){

  var html ='';
  html +='<div class="row child-idv" bis_skin_checked="1">'+
              '<div class="col-sm-4 nopadding" bis_skin_checked="1">'+
              '  <div class="form-group" bis_skin_checked="1">'+
                  '<input type="text" class="form-control" name="prescription_number[]" value="" placeholder="Rx# 20231003-0000000001" required="">'+
                '</div>'+
              '</div>'+
              '<div class="col-sm-4 nopadding" bis_skin_checked="1">'+
                '<div class="form-group" bis_skin_checked="1">'+
                    '<input type="file" class="form-control" name="prescription_img[]" value="" placeholder="Prescription Image" >'+
               ' </div>'+
             ' </div>'+
              '<div class="col-sm-4 nopadding" bis_skin_checked="1">'+
                '<div class="form-group" bis_skin_checked="1">'+
                  '<div class="input-group align-items-center" bis_skin_checked="1">'+
                    '<input type="text" class="form-control" name="medication_name[]" value="" placeholder="Medication Name" required="" min="1" tep="1">'+
                    '<div class="input-group-btn ml-2" bis_skin_checked="1">'+
                      '<button class="btn btn-success remove_prescription_field" type="button" onclick="remove_prescription_field()">'+
                        '<span class="fa fa-minus" aria-hidden="true"></span>'+
                      '</button>'+
                   ' </div>'+
                  '</div>'+
                '</div>'+
              '</div>'+
              '<div class="clear" bis_skin_checked="1"></div>'+
            '</div>';

            $(".loader-container").show();
            $('.append-html').append(html);
      setTimeout(function() {
          // Hide the loader after the form is submitted
          
          $(".loader-container").hide();
        }, 300); // 2000 milliseconds (2 seconds) is an example, adjust as needed





}


  $('.askForRefill').change(function(){
    if($(this).is(":checked")) {

      //$('#ask-for-refill').modal('show');
      //return false;
      _this = $(this);

      // console.log('sd jkl');
    swal({
          title: "Do you want to proceed with this?",
          text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes",
          closeOnConfirm: false
        },
    function(){

        // console.log(_this.attr('id'));
        var id = _this.attr('id');
      swal.close();
      $(".loader-container").show();

      $.ajax({
        url: "{{ route('frontend.user.prescription.refill.ajax') }}",
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            prescription_id: id
        },
        dataType: 'json', // Specify that you expect a JSON response
        success: function(response) {
          $(".loader-container").hide();
            // Assuming there's a div with id 'form-container' where you want to render the form
            $('#ask-for-refill').modal({backdrop: 'static', keyboard: false,show:true});
            if(response.html){
              $('#address-form').html(response.html); // Assuming the JSON response contains the HTML in 'html' attribute
            }else{
              $('#address-form').html('');
            }
        },
        error: function(xhr) {
          $('#ask-for-refill').modal('hide');
            // Handle error
            console.log(xhr.responseText);
            $('#address-form').html('');
        }
      });


    
     // window.location.href= "{{ route('frontend.user.prescription.refill', ['id' => '__id__']) }}".replace('__id__', id);
    });

    }
    
    
  })

  function prescritpionDelted(id){
    event.preventDefault();
    swal({
          title: "Do you want to proceed with this?",
          text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes",
          closeOnConfirm: false
        },
    function(){
      swal.close();
      $(".loader-container").show();
      // console.log(_this.attr('id'));
      
      window.location.href= "{{ route('frontend.user.prescription.delete', ['id' => '__id__']) }}".replace('__id__', id);
    });
  }
  </script>


@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush