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
        font-size: 13px;
        font-weight: 300;
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
li.ajax-li:hover {
    background-color: #638e3cd9;
    color: #fff;
}
.from-div-main , .to-div-main{
    border: 1px solid #638e3c;
    border-radius: 8px;
    background-color: #638e3c2b;
    padding: 8px 0 0 8px;
    margin-bottom: 8px;
}
.selected-pharma p.heading {
    margin: 0;
    margin-top: 10px;
    padding-left: 8px;
    font-size: 18px;
    font-weight: 600;
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
                              </div>
                            <div class="selected-pharma" style="display:none;">
                              <p class="heading">Transfer Request</p>
                              <div class="from-div-main">
                                <h6>From:</h6>
                                <div class="from-div">
                                  <span>From st pharmacy</span>
                                  <address>asdfassdfdf</address>
                                </div>
                              </div>
                              <div class="to-div-main">
                                <h6>To:</h6>
                                <div class="to-div">
                                  <span>Mister Pharmacy Canada.</span>
                                  <address>asdfassdfdf</address>
                                </div>
                              </div>

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
      $('.ajax-result').fadeOut();     
      $('#search').keyup(function(){
          console.log('safadsfasf');
          var thismain  = $(this);
          var search    = $(this).val();
          
          if(search){
           placelistView(thismain,search);
          }else{
            $('.ajax-result').fadeOut();  
            // $('.ajax-ul').fadeOut();
            // $('.ajax-result').fadeIn();
          }
            
        })
        
        $('.ajax-result').on('click','.ajax-li',function(){
          console.log($(this).text());
          console.log($(this).html());
          $('.ajax-result').fadeOut();
          $('.from-div').html($(this).html());
          $('.selected-pharma').fadeIn();
          $('#search').val($(this).find('span').text());

        })

     
    });

    function placelistView(thismain,search=''){
      
      ajaxurl = "{{ route('frontend.user.place.ajax.search') }}";
        _token = "{{ csrf_token() }}";
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {_token:_token,search:search},
            success: function(data){
                if(data){
                    console.log(data.html); 
                    $('.ajax-result').html(data.html);
                    $('.ajax-result').fadeIn();
                }else{

                }
            }
        });

    }
 

      </script>
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush