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
                <i class="fa fa-credit-card" aria-hidden="true"></i>
                <p class="txt-large">Select Payment Method</p>
                <p class="txt">Welcome latest design trends Designed with the latest design trendsDesigned with the latest design trends </p>
              </div> 

				    </div>
            <div class="col-md-2">
              </div>
				    <div class="col-md-8">
              <div class="tab-pane" id="tabs-2" role="tabpanel" aria-labelledby="tab-2">
                <div class="order">
                  <div class="order-head">                  
                    <input type="radio" name="payment" value="payment"> <p class="txt-b">**** 6633</p>                     
                    </div>
                   <div class="order-body">
                    <div class="row">
                      <div class="col-md-8">  
                        <p class="txt">08/2023</p>
                        <a class="txt-b" href="#"> Delete </a>
                    
                      </div>
                      <div class="col-md-4 text-right">  
                        <a href="#"><img src="./assets/images/visa.png" /></a>
                      </div>
                  </div> 
                    
  
                    </div> 
                  </div>
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
       
     
    });
 

      </script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush