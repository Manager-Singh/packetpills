@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<link rel="stylesheet" href="{{asset('website/assets/css/order-pg-style.css')}}">
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

    <div class="row mt-0">
        <div class="col-md-1">
        </div>
        <div class="col-md-10 order-page">   
            <div class="pagenation">
            @if (in_array($order->order_status, array('cancelled', 'declined', 'processing', 'ready_to_pick', 'picked_up', 'in_transit', 'delivered')))
            <p class="order-step bigg order-step-one completed">Approved</p>
            @elseif($order->order_status == 'approved')
            <p class="order-step bigg order-step-one complete">Approved</p>
            @else
            <p class="order-step smmall order-step-one">Approved</p>
            @endif

            @if (in_array($order->order_status, array('processing', 'ready_to_pick', 'picked_up', 'in_transit', 'delivered')))
            <p class="order-step bigg order-step-two completed"><span class="on-top">Processing</span></p>
            @elseif($order->order_status == 'processing')
            <p class="order-step bigg order-step-two complete"><span class="on-top">Processing</span></p>
            @else
            <p class="order-step smmall order-step-two"><span class="on-top">Processing</span></p>
                
            @endif

            @if (in_array($order->order_status, array('picked_up', 'in_transit', 'delivered')))
            <p class="order-step bigg order-step-three completed">Ready To Pick</p>
            @elseif($order->order_status == 'ready_to_pick')
            <p class="order-step bigg order-step-three complete">Ready To Pick</p>
            @else
            <p class="order-step smmall order-step-three">Ready To Pick</p>
                
            @endif
                
            @if (in_array($order->order_status, array('in_transit', 'delivered')))
            <p class="order-step bigg order-step-four completed"><span class="on-top">Picked Up</span></p>
            @elseif($order->order_status == 'picked_up')
            <p class="order-step bigg order-step-four complete"><span class="on-top">Picked Up</span></p>
            @else
            <p class="order-step smmall order-step-four"><span class="on-top">Picked Up</span></p>
                
            @endif
            @if (in_array($order->order_status, array('delivered')))
            <p class="order-step bigg order-step-five completed">In-transit</p>
            @elseif($order->order_status == 'in_transit')
            <p class="order-step bigg order-step-five complete">In-transit</p>
            @else
            <p class="order-step smmall order-step-five">In-transit</p>   
            @endif
            @if($order->order_status == 'delivered')
            <p class="order-step bigg order-step-six complete"><span class="on-top">Delivered</span></p>
            @else
            <p class="order-step smmall order-step-six"><span class="on-top">Delivered</span></p>    
            @endif
               
                
                
                
            </div>

            <div class="order-details">
                <div class="row">
                    <div class="col-md-4 offset-4 text-center">
                    <p class="text">Created On</p>
                    <p class="sub-text">{{$order->created_at->format('F d, Y ')}}</p>
                </div>
                <!-- <div class="col-md-4">
                    <p class="text">Total Copay</p>
                    <p class="sub-text">${{$order->total_amount}}</p>
                </div>
                <div class="col-md-4">
                    <p class="text">order receipt</p>
                    <a class="sub-text">Download</a>
                </div> -->
                </div>
            </div>
            <div class="order-description">           
                <div class="check-block">
                    <div class="main">              
                        <p>Order Status</p>
                    </div>
                    <div class="sub">              
                        <p>{{ date_format($order->updated_at,'D, F d, Y') }}</p>
                        <p class="left">{{ orderStatusText($order->order_status) }}</p>
                    </div>
                    <div class="main">              
                        <p>Shipping Address</p>
                    </div>
                    <div class="sub">              
                        <p>{{($address) ? $address->address1 .' '.$address->address2 .', '.$address->province .', '.$address->city  : ''}}</p>
                    </div>
                    <!-- <div class="main">              
                        <p>Transactions</p>
                    </div>
                    <div class="sub">              
                        <p><img src="{{ asset('website/assets/images/visa.png')}}" />xxxx xxxx xxxx {{ (isset($paymentmethod)) ? substr($paymentmethod->card_number,-4) : '6633' }}</p>
                        <p class="left">$8.38</p>
                    </div> -->
                    <div class="main">              
                        <p>Medications</p>
                    </div>
                    <div class="sub">   
                        @if(isset($order) && isset($order->order_items))
                            @foreach($order->order_items as $item)
                                <p><strong>{{$item->medication->drug_name}}</strong></p>
                                <p class="left">${{$item->medication->price}}</p>
                            @endforeach 
                        @else

                        @endif           
                        
                        
                        <!-- <p>Total cost</p>
                        <p class="left">${{$order->total_amount}}</p> -->
                        <!-- <p>Government</p>
                        <p class="left">-$0.00</p>
                        <p>Insurance</p>
                        <p class="left">-$00.00</p>  -->
                        <p class="dotted">
                            <!-- <strong>Copay</strong> -->
                        </p>
                        <p class="left dotted">
                            <!-- <strong>${{$order->total_amount}}</strong> -->
                        </p>
                        <p><strong>Total Cost</strong></p>
                        <p class="left"><strong>${{$order->total_amount}}</strong></p>
                        <small><strong>Note: Rx Fee $9.99/Prescription is included</strong></small>
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