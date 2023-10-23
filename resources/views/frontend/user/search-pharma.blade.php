@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
	<link rel="stylesheet" href="{{asset('website/assets/css/dashboard.css')}}">
  <style>
    .btn-div a {
    display: contents;
    }
    li.ajax-li span {
      font-size: 18px;
      font-weight: 500;
    }
    li.ajax-li address {
    font-size: 14px;
    font-weight: 200;
}
.ajax-result ul.ajax-ul {
    list-style: none;
    padding: 0;
    margin: 0;
    border: 1px solid #638e3c;
    border-radius: 8px;
}
li.ajax-li {
    border-bottom: 1px solid #638e3c;
    padding: 4px 0 0 10px;
    cursor: pointer;
}
  </style>
@endpush
@section('content')
<div class="container mt-0 mb-5 pt-0">
		    	<div class="row ">
				    <div class="col-md-6">
              <div class="user-info">
                <img class="user-img" src="{{asset('website/assets/images/user.png')}}">
                <p class="txt">Transfer your refills</p>
                <p class="txt">Search and select your current pharmacy </p>
              </div> 

				    </div>
				    <div class="col-md-6">

                        <form name="myForm" action="/action_page.php" method="get">
                            <div class="row">
                            <div class="col-md-12">
                            <input type="text" id="search" name="serch" placeholder="Search for your current pharmacy">
                            <div class="ajax-result">
                             <ul class="ajax-ul" style="display:none;">
                                <li class="ajax-li">
                                  <span>Front st pharmacy</span>
                                  <address>431 king st e, Toronto</addrdess>
                                </li>
                                <li class="ajax-li">
                                  <span>Front st pharmacy 1</span>
                                  <address>431 king st e, Toronto</addrdess>
                                </li>
                                <li class="ajax-li">
                                  <span>Front st pharmacy2</span>
                                  <address>431 king st e, Toronto</addrdess>
                                </li>
                             </ul>

                            </div>
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
<script>
   
    $(document).ready(function(){       
      $('#search').keyup(function(){
          console.log('safadsfasf');
          if($(this).val()){
            $('.ajax-ul').fadeIn();
          }else{
            $('.ajax-ul').fadeOut();
          }
            
        })

     
    });
 

      </script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush