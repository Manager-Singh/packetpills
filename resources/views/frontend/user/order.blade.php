@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<style>
.btn-error, .btn-success {
    background: #8ac03d;
    border-radius: 30px;
    text-decoration: none !important;
    color: #fff;
    padding: 3px 10px;
}
.btn-error:hover , .btn-success:hover {
    background-color: #fff;
    color: #8ac03d;
    border: 1px solid #638e3c;
}
.order-pg a {
    text-decoration: unset;
    color: #212843;
}
div#accordionExample {
    padding: 3rem 19rem 4rem 3rem;
}
body main.main-div {
    margin-top: 0rem;
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
        <!-- <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-2" data-mdb-toggle="tab" href="#cancelled" role="tab" aria-controls="tabs-2" aria-selected="false">Delivered</a>
        </li> -->

    </ul>
    <div class="row mt-0 order-pg">
    <div class="col-md-1">
        </div>
    <div class="col-md-10">
    <div class="tab-content mb-5" id="content">
        <div class="tab-pane fade show active" id="tabs-1" role="tabpanel" aria-labelledby="tab-1">
            @if($orders->isNotEmpty())
            @foreach($orders as $order)
                <a href="{{ route('frontend.user.order.single',['order_no'=>$order->order_number]) }}">
                    <div class="order">
                        <div class="order-head">
                            <div class="row">
                                <div class="col-md-8">  
                                    <p class="txt">Created On: {{$order->created_at->format('F d, Y ')}}</p>
                                </div>
                                <div class="col-md-4 text-right">  
                                    <span class="btn-success"> {{ ucfirst(str_replace('_', ' ', $order->order_status))}} </span>
                                </div>
                            </div>
                        </div>
                        <div class="order-body">
                            <p class="txt">Order Number: {{$order->order_number}}</p>
                            <p class="txt-b">Order requested from {{$user->full_name}}</p>

                        </div> 
                    </div>
                </a>

            @endforeach

            @else
                <div class="order">
                <div class="order-head">
                    <p class="txt text-center">Not Order found!</p>
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
                <a class="btn-success" href="#"> Delivered </a>
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
    <div class="col-md-1">
    </div>
    </div>
@endsection

@push('after-scripts')
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush