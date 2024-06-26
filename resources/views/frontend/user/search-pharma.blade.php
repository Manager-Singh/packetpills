@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
	<link rel="stylesheet" href="{{asset('website/assets/css/dashboard.css')}}">
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
    margin: 4rem;
    text-align: center;
    font-size: 16px;
}
 </style>
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
    overflow-y: scroll;
    height: 329px;
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
tr.status-cancelled td {
    background: #ff000033;
}
  </style>
@endpush
@section('content')
<div class="container mt-0 mb-5 pt-0" id="main_scroll">
		    	<div class="row ">
				    <div class="col-md-6">
              <div class="user-info">
                <img class="user-img" src="{{asset('website/assets/images/user.png')}}">
                <p class="txt">Transfer your refills</p>
                <p class="txt">Search and select your current pharmacy </p>
                <p class="txt">Can't find your pharmacy on the list?</p>
                <p class="txt">Enter your prescription(s) transfer request <a target="_blank" href="https://misterpharmacist.com/prescription-transfers/">here</a>!</p>
              
              
              </div> 

				    </div>
				    <div class="col-md-6">

                        <form name="myForm" enctype='multipart/form-data' action="{{route('frontend.user.transfer.request')}}" method="post">
                        @csrf     
                        <div class="row">
                            <div class="col-md-12">
                              <input type="text" id="search" name="serch" placeholder="Search for your current pharmacy">
                              <div class="ajax-result" style="display:none;">
                              <ul class="ajax-ul" style="display:block;"></ul>
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
                                  <span>MisterPharmacist Pharmacy.</span>
                                  <address>116A Sherbourne street, Toronto, Ontario M5A 2R2 -Canada</address>
                                </div>
                              </div>

                            </div>
          <!-- <p class="error"><span>Postal Code Not Found</span><a href="#">Change</a></p>-->
                          </div>
                           
                            <div class="col-md-12">
                                <!-- <label for="lname">Populer Searches</label>
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
                                </div> -->
                            </div>
                        </div>
                        <input type ="hidden" id="place_id" name="place_id"/>
                        <div class="btn-div transfer-request" style="display:none;">
                        
                 <button type="submit" id="submit" class="next button" >Transfer Request</button>
                 </div>
                 <input type="hidden" id="next_page_t" name="page_token" value="" />     
                      </form>
                            @if($transfer_request->count() > 0)
                            <p class="heading pt-1"><b>All Transfer Requests</b></p>
                            <table class="table table-hover">
                              <tbody>
                                <tr>
                                  <th>Pharmacy</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                                @foreach($transfer_request as $trequest)
                                  <tr class="status-{{$trequest->status}}">
                                    <td><small>{{$trequest->formatted_address}}</small></td>
                                    <td><small>{{$trequest->status}}</small></td>
                                    @if(isset($trequest->status) && $trequest->status == 'cancelled')
                                    <td><small class="btn btn-danger" disabled>Cancelled</small></td>
                                    @else
                                    <td><small class="btn btn-danger" onclick="transferRequestCancle('{{$trequest->id}}')">Cancel</small></td>
                                    @endif
                                    
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            @endif
                 
                 
                </div>
 
			
			</div>
		</div>
@endsection

@push('after-scripts')

<script>
  var pageToken = null;
  var ajaxTriggered = false;

  $(document).ready(function(){  
    $('.ajax-result').fadeOut();     
    $('#search').keyup(function(){
      
      var thismain  = $(this);
      var search    = $(this).val();
      $('.ajax-result .ajax-ul').html('');

      setTimeout(function() {
        if(search.length > 2){
          placelistView(thismain,search,null,null);
          //ajaxScroll();
        }else{
          $('.ajax-result').fadeOut();  
          // $('.ajax-ul').fadeOut();
          // $('.ajax-result').fadeIn();
        }
            

      }, 300);
    
    })
        
    $('.ajax-result').on('click','.ajax-li',function(){
      $('.ajax-result').fadeOut();
      $('.from-div').html($(this).html());
      $('.selected-pharma').fadeIn();

      $('#search').val($(this).find('span').text());

      var place_id = $(this).attr('data-placeid');

      $('#place_id').val(place_id);
      $('.transfer-request').fadeIn('slow');
    })
  });

  function placelistView(thismain,search='',pageToken=null, isfrom=true){
      $(".loader-container").show();
      var lat=$('#latitude').val();
      var long=$('#longitude').val();
      
      ajaxurl = "{{ route('frontend.user.place.ajax.search') }}";
        _token = "{{ csrf_token() }}";
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {_token:_token,search:search,lat:lat,long:long,pageToken:pageToken},
            success: function(data){
                if(data){
                    //console.log(data); 
                  $('.ajax-result .ajax-ul').html(data.html);
                    if(data.pageToken){
                      ajaxTriggered = false;
                      pageToken = data.pageToken;
                      $('#next_page_t').val(data.pageToken);
                    }else{
                      ajaxTriggered = true;
                      pageToken = null;
                      $('#next_page_t').val('');
                    }
                    $('.ajax-result').fadeIn();
                    $(".loader-container").hide();
                    
                }else{

                }
            }
        });

    }

    function placelistViewScroll(thismain,search='',pageToken=null, isfrom=true){
      $(".loader-container").show();
      var lat=$('#latitude').val();
      var long=$('#longitude').val();
      
      ajaxurl = "{{ route('frontend.user.place.ajax.search') }}";
        _token = "{{ csrf_token() }}";
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {_token:_token,search:search,lat:lat,long:long,pageToken:pageToken},
            success: function(data){
                if(data){
                    //console.log(data); 
                   if(pageToken && data.pageToken){
                      pageToken = data.pageToken;
                      $('.ajax-result .ajax-ul').append(data.html);
                      $('#next_page_t').val(data.pageToken);
                      ajaxTriggered = false;
                    }else{
                      pageToken = null;
                      $('#next_page_t').val('');
                      ajaxTriggered = true;
                    }
                    
                    $('.ajax-result').fadeIn();
                    $(".loader-container").hide();
                    
                }else{

                }
            }
        });

    }
 
    function transferRequestCancle(id){
    event.preventDefault();
    swal({
          title: "Do you want to cancel?",
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
      
      
      window.location.href= "{{ route('frontend.user.transfer.request.delete', ['id' => '__id__']) }}".replace('__id__', id);
    });
  }

 
    var $yourSection = $('.ajax-result ul.ajax-ul'); 
    // Flag to track if AJAX request has been triggered

   // Attach a scroll event listener to the selected section
    $yourSection.scroll(function() {

        if($('#next_page_t').val()){
          pageToken = $('#next_page_t').val();
        }
        var scrollTop = $yourSection.scrollTop();
        var sectionHeight = $yourSection.height();
        var scrollHeight = $yourSection[0].scrollHeight;
        
        // Add your conditions based on scroll position within the section
        if ((scrollTop + sectionHeight >= scrollHeight) && (!ajaxTriggered) && pageToken) {
          ajaxTriggered = true;
          var thismain  = $('#search');
          var search    = $('#search').val();
          placelistViewScroll(thismain,search,pageToken); //ajax hit
        }
        
    });


      </script>



@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush