@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<link rel="stylesheet" href="{{asset('website/assets/css/dashboard.css')}}">
@endpush
@section('content')

<div class="container mt-5 mb-5 pt-5">
    <div class="row ">
        <div class="col-md-12">
            <div class="user-info p-details">
                <i class="fa fa-home" aria-hidden="true"></i>
                <p class="txt-large">Select shipping address</p>
                <p class="txt">Welcome latest design trends Designed with the latest design trendsDesigned with the
                    latest design trends </p>
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
                        <input type="radio" name="payment" {{ (isset($addres->mark_as) && $addres->mark_as == 'default') ? 'checked' : '' }} value="payment">
                        <p class="txt-b">{{$addres->address_type}}</p>
                    </div>
                    <div class="order-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="txt"> {{$addres->address1}}  {{$addres->address2}}</p>
                                <p class="txt"> {{$addres->city}} {{$addres->province}}</p>
                                <a class="txt-b" href="javascript:void(0)" onclick="removeAddress({{$addres->id}},{{$user->id}})"> Delete </a>
                                <a class="txt-b" href="{{route('frontend.user.address.add')}}?id={{$addres->id}}"> Edit </a>
                            </div>
                        </div>
                    </div>
                  </div>
                @endforeach
               @else
               @endif 
                <div class="order-footer mt-5">
                    <a class="btn-big" href="{{route('frontend.user.address.add')}}">+ Add anew address</a>
                </div>
                <div class="btn-div">
                    <button type="button" class="save button" onclick=""> Back </button>
                    <button type="button" class="next button" onclick="">Continue</button>

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


});

function removeAddress(id,user_id) 
    {
        console.log(id);
        
       
        swal({
            title: "Are you sure you want to do this?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
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