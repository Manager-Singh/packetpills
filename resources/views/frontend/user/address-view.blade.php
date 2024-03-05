@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<link rel="stylesheet" href="{{asset('website/assets/css/dashboard.css')}}">
<link rel="stylesheet" href="{{asset('step/assets/css/after-login-style.css')}}">
<style>
.order .order-head input[type='radio']:checked:after {
    width: 26px;
    height: 26px;
    border-radius: 21px;
    top: 0px;
    left: 0px;
    position: relative;
    background-color: #8ac03d;
    content: '';
    display: inline-block;
    visibility: visible;
    border: 2px solid white;
}

</style>
@endpush
@section('content')
@php 
$address_count = ($address) ? $address->count() : 0;
@endphp
<div class="container mt-0 mb-5 pt-0 address-view-pg">
    <div class="row ">
        <div class="col-md-12">
            <div class="user-info p-details">
               <i class="fi fi-br-address-book fa"></i>
                <p class="txt-large">Select shipping address</p>
                
            </div>

        </div>
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="tab-pane" id="tabs-2" role="tabpanel" aria-labelledby="tab-2">
               @if($address)
                @foreach($address as $addres)
                  <div class="order address-{{$addres->id}}">
                    <div class="order-head">
                        <!-- <input type="radio" class="address-default" name="payment"  {{ (isset($addres->mark_as) && $addres->mark_as == 'default') ? 'checked' : '' }} value="{{$addres->id}}"> -->
                        <p class="txt-b">{{$addres->address_type}}</p>
                    </div>
                    <div class="order-body">
                        <div class="row">
                            <div class="col-md-8">
                                    <p class="txt"> {{$addres->address1}}  {{$addres->address2}}, {{$addres->city}}, {{$addres->province}}, {{$addres->postal_code}}</p>
                                    <!-- <p class="txt"> {{$addres->postal_code}}</p>
                                    <p class="txt"> {{$addres->city}} {{$addres->province}}</p> -->
                                @if(isset($addres->shipping_instructions) && !empty($addres->shipping_instructions))
                                <p class="txt"> <p class="txt-b m-0">Address Instructions:</p> {{$addres->shipping_instructions}}</p>
                                @endif
                                <a class="txt-b delete-btn" href="javascript:void(0)" onclick="removeAddress({{$addres->id}},{{$user->id}})"> Delete </a>
                                <a class="txt-b edit-btn" href="{{route('frontend.user.address.add')}}?id={{$addres->id}}"> Edit </a>
                            </div>
                        </div>
                    </div>
                  </div>
                @endforeach
               @else
               @endif 
               @if($address_count < 2)
                <div class="order-footer mt-5">
                    <a class="btn-big" href="{{route('frontend.user.address.add')}}">+ Add anew address</a>
                </div>
               @endif
                <div class="btn-div">
                    <button type="button" class="save button" onclick="window.location='{{ route('frontend.user.personal.details') }}'"> Back </button>
                    <button type="button" class="next button" onclick="window.location='{{ route('frontend.user.personal.details') }}'">Continue</button>

                </div>
            </div>


        </div>
        <div class="col-md-2">
        </div>

    </div>
</div>
@endsection

@push('after-scripts')
<script>
$(document).ready(function() {
    $('.address-default').on('click',function(){
        console.log($(this).val());
        var id = $(this).val();
        var user_id = "{{auth()->user()->id}}";
        ajaxurl = "{{ route('frontend.user.address.default.change') }}";
        _token = "{{ csrf_token() }}";
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {_token:_token,id:id,user_id:user_id},
            success: function(data){
                if(data.success)
                {
                    //$('.address-'+id).fadeOut('slow');
                    //swal("Success!", 'Address Default is set.', "success");
                    //location.reload();
                }
            }
        });

        

    })


});

function removeAddress(id,user_id) 
    {
        console.log(id);
        
       
        swal({
            title: "Do you want to delete?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: false
            },
            function(){
                ajaxurl = "{{ route('frontend.user.address.delete') }}";
                            _token = "{{ csrf_token() }}";
                            $.ajax({
                                url: ajaxurl,
                                type: "POST",
                                data: {_token:_token,id:id,user_id:user_id},
                                success: function(data){
                                    if(data.success)
                                    {
                                        $('.address-'+id).fadeOut('slow');
                                        swal("Success!", 'Address Deleted.', "success");
                                        //location.reload();
                                    }
                                }
                            });
            });

        return false;


     
    }
</script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush