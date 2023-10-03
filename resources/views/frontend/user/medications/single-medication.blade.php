@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
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

.autocom-box.ajax-result {
    height: 400px;
    overflow-y: scroll;
    z-index: 1000;
    border: 1px solid #eee;
    box-shadow: 0px 0px 3px 3px #eee;
    border-radius: 3px;
}

</style>

<div class="container mt-5 mb-5">
		    	<div class="row ">
            
				    <div class="col-md-12">
              <div class="user-info p-details">
                <p class="txt-large">Buy {{$drug->brand_name}} Online in Canada</p>
                <p class="bold-txt mt-3"> Get your {{$drug->brand_name}} delivered at your door for FREE</p>            
                
               </div> 

				    </div>
            <div class="col-md-6">
              <div class="bredcrumbs mt-5">Home > Drug > {{$drug->brand_name}}</div>
              <div class="prescription"> <input type="checkbox" id="prescription" name="prescription" value="Prescription Required" checked  />
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
                <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-mdb-ride="carousel">
                  <!-- Slides -->
                  <div class="carousel-inner mb-5">
                    <div class="carousel-item active">
                      <img src="{{asset('website/assets/images/home-banner-2.png')}}" class="d-block w-100" alt="..." />
                    </div>
                    <div class="carousel-item">
                      <img src="{{asset('website/assets/images/home-banner-2.png')}}" class="d-block w-100"
                        alt="..." />
                    </div>
                    <div class="carousel-item">
                      <img src="{{asset('website/assets/images/home-banner-2.png')}}" class="d-block w-100" alt="..." />
                    </div>
                  </div>

                  <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleIndicators"
                    data-mdb-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleIndicators"
                    data-mdb-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>

                  <div class="carousel-indicators" style="margin-bottom: -20px;">
                    <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="0" class="active"
                      aria-current="true" aria-label="Slide 1" style="width: 100px;">
                      <img class="d-block w-100"
                        src="{{asset('website/assets/images/home-banner-2.png')}}" class="img-fluid" />
                    </button>
                    <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="1"
                      aria-label="Slide 2" style="width: 100px;">
                      <img class="d-block w-100"
                        src="{{asset('website/assets/images/home-banner-2.png')}}" class="img-fluid" />
                    </button>
                    <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="2"
                      aria-label="Slide 3" style="width: 100px;">
                      <img class="d-block w-100"
                        src="{{asset('website/assets/images/home-banner-2.png')}}" class="img-fluid" />
                    </button>
                  </div>
                  <!-- Thumbnails -->
                </div>
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
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    $<span class="d-total" data-total="{{$drug->patient_pays}}">{{$drug->patient_pays}} </span>
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
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


