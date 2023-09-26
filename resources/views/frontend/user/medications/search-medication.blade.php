@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<style>
ul.drug-list-main {
    list-style: none;
    text-align: left;
    background: #eee;
    width: 50%;
}

</style>
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
        <div class="autocom-box ajax-result">
         
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
             <div class="col-md-4 mb-3">
                <div class="single-result">
                  <img src="./assets/images/icon-rx.png" />
                  <p>5-Aminosalicylic Acid </p>
                  <a href="">View</a>  
                </div>
              </div>

              <div class="col-md-4">
                <div class="single-result">
                  <img src="./assets/images/icon-rx.png" />
                  <p>5-Aminosalicylic Acid </p>
                  <a href="">View</a>  
                </div>
              </div>

              <div class="col-md-4">
                <div class="single-result">
                  <img src="./assets/images/icon-rx.png" />
                  <p>5-Aminosalicylic Acid </p>
                  <a href="">View</a>  
                </div>
              </div>

              </div>
              <div class="row mb-3">
                <div class="col-md-4">
                   <div class="single-result">
                     <img src="./assets/images/icon-rx.png" />
                     <p>5-Aminosalicylic Acid </p>
                     <a href="">View</a>  
                   </div>
                 </div>
   
                 <div class="col-md-4">
                   <div class="single-result">
                     <img src="./assets/images/icon-rx.png" />
                     <p>5-Aminosalicylic Acid </p>
                     <a href="">View</a>  
                   </div>
                 </div>
   
                 <div class="col-md-4">
                   <div class="single-result">
                     <img src="./assets/images/icon-rx.png" />
                     <p>5-Aminosalicylic Acid </p>
                     <a href="">View</a>  
                   </div>
                 </div>
   
                 </div>
                 <div class="row mb-3">
                  <div class="col-md-4">
                     <div class="single-result">
                       <img src="./assets/images/icon-rx.png" />
                       <p>5-Aminosalicylic Acid </p>
                       <a href="">View</a>  
                     </div>
                   </div>
     
                   <div class="col-md-4">
                     <div class="single-result">
                       <img src="./assets/images/icon-rx.png" />
                       <p>5-Aminosalicylic Acid </p>
                       <a href="">View</a>  
                     </div>
                   </div>
     
                   <div class="col-md-4">
                     <div class="single-result">
                       <img src="./assets/images/icon-rx.png" />
                       <p>5-Aminosalicylic Acid </p>
                       <a href="">View</a>  
                     </div>
                   </div>
     
                   </div>
                   <div class="row mb-3">
                    <div class="col-md-4">
                       <div class="single-result">
                         <img src="./assets/images/icon-rx.png" />
                         <p>5-Aminosalicylic Acid </p>
                         <a href="">View</a>  
                       </div>
                     </div>
       
                     <div class="col-md-4">
                       <div class="single-result">
                         <img src="./assets/images/icon-rx.png" />
                         <p>5-Aminosalicylic Acid </p>
                         <a href="">View</a>  
                       </div>
                     </div>
       
                     <div class="col-md-4">
                       <div class="single-result">
                         <img src="./assets/images/icon-rx.png" />
                         <p>5-Aminosalicylic Acid </p>
                         <a href="">View</a>  
                       </div>
                     </div>
       
                     </div>
                 
            </div>
        </div>
@endsection

@push('after-scripts')
<script>
   
   $(document).ready(function(){   
   })

   function druglistView(){
 var search = $('.search').val();
    ajaxurl = "{{ route('frontend.user.drug.ajax.search') }}";
        _token = "{{ csrf_token() }}";
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {_token:_token,search:search},
            success: function(data){
                if(data.success){
                    console.log(data.html);  
                    $('.ajax-result').html(data.html);
                }
            }
        });

   }
</script>


@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush


