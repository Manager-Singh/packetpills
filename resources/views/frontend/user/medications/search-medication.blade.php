@extends('frontend.layouts.website')
@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
	<link rel="stylesheet" href="{{asset('step/assets/css/common-style.css')}}">
  <style>
ul.drug-list-main {
    list-style: none;
    text-align: left;
    background: #eee;
    /* width: 50%; */
    padding: 0 0;
}

li.drug-list-child:hover {
    background: #fff;
    color: #000;
}
li.drug-list-child {
    border: 1px solid #d1a7a7;
    padding: 2px 7px;
}
.user-info.p-details {
    margin-top: 5rem;
}
.mega-footer footer {
    display: none;
}

.autocom-box.ajax-result {
    height: 400px;
    overflow-y: scroll;
    z-index: 1000;
    border: 1px solid #eee;
    box-shadow: 0px 0px 3px 3px #eee;
    border-radius: 3px;
}

</style>
@endpush
@section('content')

<div class="container mt-5 mb-5">
		    	<div class="row ">
            <div class="col-md-2">
              </div>
				    <div class="col-md-8">
              <div class="user-info p-details">
                <p class="txt-large">Search Medicines</p>
                
                   <div class="search-input">
        <a href="" target="_blank" hidden></a>
        <input type="text" class="input search" name="search" onkeyup="druglistView()" placeholder="Type to search..">
        <div class="autocom-box ajax-result" style="display:none">
        <ul class="drug-list-main">
        </ul>
        <a class="drug-list-btn loard-more-drug" style="display:none" href="javascript:void(0)">load More Data</a>
        </div>
        
      </div>
                  <p class="bold-txt mt-3">Health Resource Center</p>
                <p class="txt">Welcome latest design trends Designed with the latest design trendsDesigned with the latest design trends.</p>
              </div> 

				    </div>
            <div class="col-md-2">
              </div>
			
			</div>
      <div class="result">
        <p class="txt-large text-center"> List of Medications</p>
          <div class="row">

          @if($alldrugs)
          @foreach($alldrugs as $drug)
             <div class="col-md-4 mb-3">
                <div class="single-result">
                  <img src="{{asset('website/assets/images/icon-rx.png')}}" />
                  <p>{{$drug->brand_name}}</p>
                  <a href="{{route('frontend.drug.single',$drug->slug)}}">View</a>  
                </div>
              </div>

          @endforeach
          @else
          @endif

              
              

              
   
                
          
     
                   
       
                     
       
                     </div>
                 
            </div>
        </div>
@endsection

@push('after-scripts')
<script>
   
   $(document).ready(function(){   

   })

var page_no=0;
   function druglistView(page_no=0,type=''){
 var search = $('.search').val();
    ajaxurl = "{{ route('frontend.drug.ajax.search') }}";
        _token = "{{ csrf_token() }}";
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {_token:_token,search:search,page_no:page_no},
            success: function(data){
                if(data){
                  $('.ajax-result').fadeIn();
                    console.log(data.html);  
                    console.log(data.no_of_pages);  
                    console.log(page_no);  
                    if(data.no_of_pages > page_no){
                      console.log(data.html);
                      if(type  == 'load'){
                        $('.ajax-result ul').append(data.html);
                      }else{
                        $('.ajax-result ul').html(data.html);
                      }
                      
                      $('.loard-more-drug').show();
                    }else{
                      $('.ajax-result ul').html('');
                      $('.loard-more-drug').hide();
                    }
                    
                    
                }
            }
        });

   }

   $(document).on('click','.loard-more-drug',function(){
    
    page_no = page_no+1;
    console.log(page_no);
    druglistView(page_no,'load');
   });
</script>


@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush


