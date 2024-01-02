@extends('frontend.layouts.website')

@section('title', app_name() . ' | ' . __('navs.general.home'))
@push('after-styles')
<style>
.hero__heading {
    font-size: 3.4rem;
    line-height: 1.2;
    margin-top: 3.2rem;
}
	

</style>
<style>
		header.re-header.show {
		padding: 2px 24px;
		border-radius: 0px !important;
		background-color: #fff;
		box-shadow: 0 2px 100px #0003;
		position: fixed;
		width: 100%;
		max-width: 100% !important;
		z-index: 8;
		padding-right: 0.8rem;
		transition: top .2s ease;
	}
    p.big {
    position: absolute;
    font-size: 400px;
    color: #212843;
    text-align: center;
    align-items: center;
    left: 5%;
    top: 33%;
}
h2.display-5.pt-5 {
    font-weight: 900;
}   
img.partner-img {
    width: -webkit-fill-available;
}
	</style>
@endpush

@section('content')
<main style="margin-top:105px;">
        <div class="container mt-5 mb-5">
		    	<div class="row ">
				    <div class="col-md-6 position-relative">
                
                <h2 class="display-5 pt-5"><strong>Learn how MisterPharmacist make team healthier</strong></h2>
                
				    </div>
           
				    <div class="col-md-6">
                    {{ html()->form('POST', route('frontend.enterprise.connect.submit'))->open() }}
                    <div class="row">
                            <div class="col-md-12">
                                    {{ html()->label(__('validation.attributes.frontend.name'))->for('full_name') }}

                                    {{ html()->text('full_name', optional(auth()->user())->name)
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.name'))
                                        ->attribute('maxlength', 191)
                                        ->required()
                                        ->autofocus() }}
                               
                                    {{ html()->label(__('validation.attributes.frontend.company'))->for('company') }}

                                    {{ html()->text('company')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.company'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                              
                                    {{ html()->label(__('validation.attributes.frontend.job_title'))->for('job_title') }}

                                    {{ html()->text('job_title')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.job_title'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                               
                                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                    {{ html()->email('email', optional(auth()->user())->email)
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                           
                     
                                    {{ html()->label(__('validation.attributes.frontend.phone'))->for('phone_no') }}

                                    {{ html()->text('phone_no')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.phone'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                       

                        @if(config('access.captcha.contact'))
                          
                                    @captcha
                                    {{ html()->hidden('captcha_status', 'true') }}
                            
                        @endif

                       
                                    {{ form_submit(__('labels.frontend.contact.button')) }}
                               
                            </div><!--col-->
                        </div><!--row-->
                    {{ html()->form()->close() }}

                      
                 
                </div>
           
			
			</div>
		</div>
    <div class="row py-5 text-center" style="background-color: #e6e6e6;">
      <div class="container py-5 w-75">
      <h2><strong>Join our Partners across canada <br> priorotizing amployee health</strong></h2>
       <div class="row py-4">
         <div class="col-md-3">
            <img src="https://picsum.photos/200" class="partner-img" />
           </div>  
         <div class="col-md-3">
           <img src="https://picsum.photos/200" class="partner-img" />
           </div> 
         <div class="col-md-3">
           <img src="https://picsum.photos/200" class="partner-img" />
           </div> 
         <div class="col-md-3">
           <img src="https://picsum.photos/200" class="partner-img" />
           </div>  
       </div>
       <div class="row py-4">
        <div class="col-md-3">
           <img src="https://picsum.photos/200" class="partner-img" />
          </div>  
        <div class="col-md-3">
          <img src="https://picsum.photos/200" class="partner-img" />
          </div> 
        <div class="col-md-3">
          <img src="https://picsum.photos/200" class="partner-img" />
          </div> 
        <div class="col-md-3">
          <img src="https://picsum.photos/200" class="partner-img" />
          </div>  
      </div>
      <div class="row py-4">
        <div class="col-md-3">
           <img src="https://picsum.photos/200" class="partner-img" />
          </div>  
        <div class="col-md-3">
          <img src="https://picsum.photos/200" class="partner-img" />
          </div> 
        <div class="col-md-3">
          <img src="https://picsum.photos/200" class="partner-img" />
          </div> 
        <div class="col-md-3">
          <img src="https://picsum.photos/200" class="partner-img" />
          </div>  
      </div>
      <div class="row py-4">
        <div class="col-md-3">
           <img src="https://picsum.photos/200" class="partner-img" />
          </div>  
        <div class="col-md-3">
          <img src="https://picsum.photos/200" class="partner-img" />
          </div> 
        <div class="col-md-3">
          <img src="https://picsum.photos/200" class="partner-img" />
          </div> 
        <div class="col-md-3">
          <img src="https://picsum.photos/200" class="partner-img" />
          </div>  
      </div>
      </div>
     </div>

  </main>
 
@endsection

@push('after-scripts')
    @if(config('access.captcha.contact'))
        @captchaScripts
    @endif
@endpush