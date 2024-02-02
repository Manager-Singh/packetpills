@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
	<link rel="stylesheet" href="{{asset('website/assets/css/dashboard.css')}}">
  <link rel="stylesheet" href="{{asset('step/assets/css/after-login-style.css')}}">
@endpush
@section('content')
<div class="container mt-0 mb-5 pt-0 payment-view-pg">
		    	<div class="row ">
				    <div class="col-md-12">
              <div class="user-info p-details">
                <i class="fi fi-br-credit-card fa"></i>
                <p class="txt-large">Select Payment Method</p>
              </div> 

				    </div>
            <div class="col-md-2">
            </div>
				    <div class="col-md-8">
              <div class="tab-pane" id="tabs-2" role="tabpanel" aria-labelledby="tab-2">
                @if($payments)
                @foreach($payments as $payment)
                  <div class="order payment-{{$payment->id}}">
                    <div class="order-head">                  
                      <input type="radio" class="payment" name="payment" {{ (isset($payment->default) && $payment->default == 'yes') ? 'checked' : '' }} value="{{$payment->id}}" value="payment"> <p class="txt-b">**** {{ substr($payment->card_number, -4)}}</p>                     
                    </div>
                    <div class="order-body">
                      <div class="row">
                        <div class="col-md-8">  
                          <p class="txt">{{$payment->expiry_date}}</p>
                          <a class="txt-b delete-btn" href="javascript:void(0)" onclick="removePayment({{$payment->id}},{{$user->id}})"> Delete </a>
                      
                        </div>
                        <div class="col-md-4 text-right">  
                          <a href="#"><img src="{{asset('website/assets/images/visa.png')}}" /></a>
                        </div>
                      </div> 
                    </div> 
                  </div>
                @endforeach
                @else
                @endif
              
                </div>
                 
              <div class="order-footer mt-5">
                    <a class="btn-big" href="{{route('frontend.user.payment.add')}}">+ Add new card</a>
                </div>
                </div>
                <div class="col-md-2">
                </div>
			
			</div>
		</div>
@endsection

@push('after-scripts')
<script>
   
    $(document).ready(function(){       
      $('.payment').on('click',function(){
        console.log($(this).val());
        var id = $(this).val();
        var user_id = "{{auth()->user()->id}}";
        ajaxurl = "{{ route('frontend.user.payment.default.change') }}";
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
 
    function removePayment(id,user_id) 
    {
        console.log(id);
        
       
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
                ajaxurl = "{{ route('frontend.user.payment.delete') }}";
                            _token = "{{ csrf_token() }}";
                            $.ajax({
                                url: ajaxurl,
                                type: "POST",
                                data: {_token:_token,id:id,user_id:user_id},
                                success: function(data){
                                    if(data.success)
                                    {
                                        $('.payment-'+id).fadeOut('slow');
                                        swal("Success!", 'Payment Deleted.', "success");
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