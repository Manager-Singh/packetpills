@extends('frontend.layouts.step')
@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<style>
  main .price-calculator {
    padding: 12px;
    margin-top: 0px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px 0px #f7e3c1ba;
    background-color: #fff;
}
.product-tab .nav-tabs {
   border: unset;
}
  .product-tab .nav-tabs li.nav-item.active, .product-tab .nav-tabs li.nav-item:hover {
    background: #8ac03d !important;
  }
.product-tab .nav-tabs li.nav-item {
    border: 2px solid #638e3c !important;
   
}
  img.header-icon {
    display: none;
}
 header .row>.column {
    width: unset;
}
  .user-info.p-details {
    margin-top: 0rem;
}
.search-input input {
    width: 100%;
    padding: 4px 4px !important;
}
.mega-footer footer {
    display: none;
}
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

.autocom-box.ajax-result {
    height: 400px;
    overflow-y: scroll;
    z-index: 1000;
    border: 1px solid #eee;
    box-shadow: 0px 0px 3px 3px #eee;
    border-radius: 3px;
}
.check-img{
  width: 25px;
  height: 25px;
  padding-right: 3px;
}
.prescription {
    align-items: center;
}
.img-m {
    width: 500px;
    height: 400px;
}
.img-o {
    width: 100px;
    height: 80px;
}

</style>
@endpush
@section('content')


<div class="container mt-0 mb-5">
		    	<div class="row ">
            
				    <div class="col-md-12">
              <div class="user-info p-details">
                <p class="txt-large">Buy {{$drug->brand_name}} Online in Canada</p>
                <p class="bold-txt mt-3"> Get your {{$drug->brand_name}} delivered at your door for FREE</p>            
                
               </div> 

				    </div>
            <div class="col-md-6">
              <div class="bredcrumbs mt-5">Home > Drug > {{$drug->brand_name}}</div>
              <div class="prescription">
              <img class="check-img"  src="{{asset('website/assets/images/icons8-checked-checkbox-50.png')}}" alt="Los Angeles">
                 
                <label for="prescription">Prescription Required</label></div>
                
                    <p class="bold">Available Form: <span>{{$drug->format->name}}</span></p>
                    <p class="bold">Manufacturer name: <span>{{$drug->manufacturer}}</span></p>
                    <p class="bold">Strength: <span>{{$drug->drug_strength}} {{$drug->strenthUnit->name}}</span></p>
                    <p class="bold">Brand Name: <span>{{$drug->brand_name}}</span></p>
                    <p class="bold">Generic Name: <span>{{$drug->generic_name}}</span></p>
                    <!-- <p class="bold">Manufacturer: <span>{{$drug->manufacturer}}</span></p> -->
                    <p class="bold">Pack Size: <span>{{$drug->pack_size}}</span></p>

                    <p class="bold-txt">{{$drug->brand_name}} Indication  </p>
                  {!!$drug->drug_indication!!}
    
              </div>
              <div class="col-md-6">
                


              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  @if($drug->images->count() > 0)

                    @foreach($drug->images as $img)

                    <div class="carousel-item {{ ($loop->index == 0) ? 'active' : ''  }} ">
                            <img class="d-block w-100 img-m"
                                src="{{asset($img->image)}}"
                                alt="First slide">
                        </div>
                    @endforeach
                  @else
                  <div class="carousel-item active">
                          <img class="d-block w-100 img-m"
                              src="{{asset('website/assets/images/image-drug-p.png')}}"
                              alt="First slide">
                      </div>

                  
                  @endif

                    
                  
                </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
 
    
    <div class="container pt-4 pb-5">
        <div class="row carousel-indicators">

        @if($drug->images->count() >0)

        @foreach($drug->images as $img)

        <div class="col-md-4 item">
                        <img src="{{asset($img->image)}}"
                            class="img-o" data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" />
                    </div>
        @endforeach
        @else
        <div class="col-md-4 item">
          <img src="{{asset('website/assets/images/image-drug-p.png')}}"  class="img-o" data-target="#carouselExampleIndicators" data-slide-to="0" />
        </div>
        @endif



            

           
            

        </div>
    </div>
</div>











              
                  <!-- Slides -->
                  

                 
                  


                
                  <!-- Thumbnails -->
                
              </div>
			
			</div>

      <div class="product-tab">

        <ul class="nav-tabs">
          <li class="nav-item active" role="presentation">
            <a class="" href="#standard-dosage" role="tab" >Standard Dosage</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="" href="#side-effect" role="tab">Side Effect</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="" href="#manufacturer" role="tab">Contraindications Precautions Warnings</a>
          </li>
          
        
        </ul>
       
        </div>

      <div class="price-calculator">
        <p class="bold-txt">Price and Cost Calculator</p>
        <div class="search-input">
          <a href="" target="_blank" hidden></a>
          <input type="text" class="input search" value="{{$drug->brand_name}} {{$drug->drug_strength}} {{$drug->strenthUnit->name}}" name="search" onkeyup="druglistView()" placeholder="Type to search..">
          
        <div class="autocom-box ajax-result" style="display:none">
        <ul class="drug-list-main">
        </ul>
        <a class="drug-list-btn loard-more-drug" style="display:none" href="javascript:void(0)">load More Data</a>
        </div>
          <!-- <p class="related"><span>LAMIVUDINE 150MG</span><span>LAMIVUDINE 300MG</span></p> -->
          
          <div class="price-detail mt-5">
             <div class="d-flex">
            <p>Quantity
              <span>Total no. of {{$drug->format->name}}(S)</span></p>
            <input type="number" class="input tablet-qty" value="1"/>
            <p>Insurance coverage
              <span>We accept all insurance plans</span></p>
            <select class="insurance-coverage" name="insurance_coverage">
              <option value="0">0%</option>
              <option value="50">50%</option>
              <option value="55">55%</option>
              <option value="60">60%</option>
              <option value="65">65%</option>
              <option value="70">70%</option>
              <option value="75">75%</option>
              <option value="80">80%</option>
              <option value="85">85%</option>
              <option value="90">90%</option>
              <option value="95">95%</option>
              <option value="100">100%</option>
              </select>

              <p>Estimated copay</p>
            <div class="accordion" id="accordionExample" style="width: 32%;">
            <div class="card">  
                <div class="card-item">
                  <h2 class="card-header" id="headingOne">
                    <button class="accordion-button" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      $<span class="d-total" data-total="{{$drug->patient_pays}}">{{$drug->patient_pays}} </span>
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                      <table>
                        <tr>
                          <td>Drug cost</td>
                          <td>$<span class="drug-cost">{{$drug->drug_cost}}</span></td>
                          </tr>
                          <tr>
                          <td>Dispensing fee</td>
                          <td>$ <span class="dispensing-fee">{{$drug->dispensing_fee}}</span></td>
                          </tr>
                          <tr>
                          <td>Delivery cost</td>
                          <td>FREE</td>
                          </tr>
                          <tr>
                          <td>Insurance coverage</td>
                          <td>$<span class="insurance-cov">00.00</span></td>
                          </tr>
                        </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            
            </div>
            <div class="d-flex mt-5">
              
              <!-- <a href="#">Become a member</a> -->
              
              </div>
            </div>
         
        </div>

        </div>

        <div class="row mt-5">
   
         <div class="col-md-12">
        <div class="tab-content" id="content">
         
          <div class="tab" id="standard-dosage">
              <div>
                  <p class="bold-txt">Standard Dosage </p>
                <div class="order-body">
                  {!!$drug->standard_dosage!!}
    
                  </div> 
                </div>
                
          </div>
          <div class="tab" id="side-effect" >
            <div>
            <p class="bold-txt">Side Effect  </p>
               <div class="order-body">
               
                  {!!$drug->side_effect!!}
    
                </div> 
              </div>
          </div>

          <div class="tab" id="manufacturer" >
            <div>
              <p class="bold-txt">Contraindications Precautions Warnings </p>
               <div class="order-body">
               {!!$drug->contraindications_precautions_warnings!!}
                
    
                </div> 
              </div>
          </div>

          <!-- <div class="tab" id="brand" >
            <div>
              <p class="bold-txt">Brand</p>
               <div class="order-body">
                <p class="bold-txt">What is 3TC? </p>
                <p>Lamivudine is used in combination with other medications to treat the infection caused by the human immunodeficiency virus (HIV).  HIV is the virus responsible for acquired immune deficiency syndrome (AIDS).</p>
    
                </div> 
              </div>
          </div> -->
          
        </div>
        </div>
        </div>
    
        </div>
@endsection

@push('after-scripts')
<script>
   
   $(document).ready(function(){  
    
    $('.tablet-qty').on('blur',function(){

      console.log($(this).val());
      var price = $('.d-total').attr('data-total');
      var qty =   $(this).val();
      var disc =   $('.insurance-coverage').val();
      var sub_total = sub_total_after_discount(price,disc,qty);
      $('.d-total').text(parseFloat(sub_total).toFixed(2))


    })

   })

   function sub_total_after_discount(price,disc,qty){
    var main = price * qty ;
    
    var discount = main * disc / 100;
    var drug_actual_cost = main - $('.dispensing-fee').text();
    $('.drug-cost').text(parseFloat(drug_actual_cost).toFixed(2));
    $('.insurance-cov').text(parseFloat(discount).toFixed(2));
    return main - discount;

   }


  $(document).on("change keyup blur", ".insurance-coverage", function() {
    var price = $('.d-total').attr('data-total');
    var disc = $(this).val();
    var qty = $('.tablet-qty').val();
    var discountedTotal = sub_total_after_discount(price,disc,qty);;
    $('.d-total').text(parseFloat(discountedTotal).toFixed(2));
  });

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


