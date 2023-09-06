@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="container mt-5 mb-5 pt-5">
		    	<div class="row ">
				    <div class="col-md-6">
              <div class="user-info">
                <img class="user-img" src="{{asset('step/assets/images/user.png')}}">
                <p class="txt">Designed with the latest design trends</p>
                <p class="txt">Welcome latest design trends Designed with the latest design trendsDesigned with the latest design trends </p>
              </div> 

				    </div>
				    <div class="col-md-6">

                        <form name="myForm" action="/action_page.php" method="get">
                            <div class="row">
                            <div class="col-md-12">
                            <input type="text" id="fname" name="fname" placeholder="Search for your current pharmacy">
                             <p class="error"><span>Postal Code Not Found</span><a href="#">Change</a></p> 
                          </div>
                           
                            <div class="col-md-12">
                            <label for="lname">Populer Searches</label>
                            <div class="search-div">
                              <span class="search">                             
                                  <label>Shopping drug mart</label>
                              </span>
                              <span class="search">
                                  <label>Walmart</label> 
                              </span>
                              <span class="search">
                                  <label>Rexall</label>
                              </span>
                              <span class="search">
                                <label>Costco</label>
                              </span>
                            </div>
                          </div>
                        </div>
                            
                      </form>
                 
                 
                </div>
 
			
			</div>
		</div>
@endsection

@push('after-scripts')
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush