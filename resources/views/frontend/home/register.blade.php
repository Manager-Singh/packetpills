
<div class="hero hero--desktop hero--exp-2"
    style="background-size: auto 140%;background-position: center center;padding-bottom: 0;min-height: 100vh;background-repeat: no-repeat; background-image: url({{asset('website/assets/images/bg-signup-modal.webp')}});">
    <div class="landing-wrapper margin-t-xl">
        <div class="content-exp2">
            <div>
                <h1 class="hero__heading color-brand font-bold txt-c"> You're almost there! </h1>
                
            </div>

        </div>
        <div class="row center-xs">
            <div class="column column--xs-8 column--s-8 column--m-6 column--l-5 column--xl-4">
                <div class="hero__form margin-t-xl hero__form--vertical signup-form--desktop">

                    <div aria-label="Sign up with Pocketpills">
                        @if(Auth::check())
                            <p class="paragraph font-semibold hero__form-label txt-center--xs color-brand">Hi, Alexandre</p>
                            <p class="paragraph font-semibold hero__form-label txt-center--xs color-brand"> Welcome back!</p><a href="{{route('frontend.user.account')}}"><button _ngcontent-serverapp-c48="" type="submit" class="btn btn--brand txt-defaultcase"><span _ngcontent-serverapp-c48="" translate="" class="button__label txt-defaultcase">Go to dashboard</span><i class="fa fa-angle-arrow-right" aria-hidden="true"></i></button></a>
                        @else

                        <p class="paragraph font-semibold hero__form-label txt-center--xs color-brand">Simply sign in to
                            join over 300,000 satisfied members:</p>

                        @endif



                        <div class="row row--nogutters">
                            <div class="column column--xs-12 row row--nogutters center-xs">
                                <div class="hero__form-wrapper">
                                    <div class="hero__form-row row row--nogutters row--grow-3">
                                        <div class="column column--xs full-width">
                                            <div class="hero__form-field">
                                                @if(!Auth::check())
                                                <form novalidate="" action="{{route('frontend.auth.login.post')}}" method="POST" class="ng-untouched ng-pristine ng-valid">
                                                

                                                <div class="form-inline">
                                                    <div class="form-inline__form">
                                                        <label class="hide-label"
                                                            for="phone-number">Phone</label>
                                                        <div class="tel">
                                                            <div class="tel-prefix txt-c" aria-label="Country code +1">
                                                                <p class="color-dark font-semibold">+1</p>
                                                            </div>
                                                            <div class="tel-input">
                                                                <input autocomplete="off" type="tel"
                                                                    oninput="javascript: if (this.value.length &gt; 10) this.value = this.value.slice(0, 10);"
                                                                    onkeypress="return (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57) || event.charCode == 13"
                                                                    keyname="landing.fields.phone" contenteditable="true"
                                                                    class="home-input full-width font-semibold ng-untouched ng-pristine ng-invalid"
                                                                    id="phone-number"
                                                                    placeholder="10 digit phone number" aria-required="true"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-inline">
                                                    <div class="form-inline__form">
                                                    <div class="row">
                                                        <div class="col otp-box hide" style="display:none;">
                                                            <div class="form-group">
                                                                {{ html()->label(__('validation.attributes.frontend.otp'))->for('otp') }}

                                                                {{ html()->text('otp')->class('form-control')->placeholder(__('validation.attributes.frontend.otp'))->attribute('id','otp')->attribute('maxlength', 6)->attribute('minlength', 6)->required() }}
                                                                <span class="genrated-otp"></span>
                                                            </div><!--form-group-->
                                                        </div><!--col-->
                                                    </div><!--row-->
                                                        
                                                    </div>

                                                </div>


                                                <div class="margin-t-l">
                                                    <button type="button" class="btn btn--full btn--brand txt-defaultcase lineheight-reset request-otp">{{ __('labels.frontend.auth.get_started') }}</button>
                                                    <button type="button" class="btn btn--full btn--brand txt-defaultcase lineheight-reset register-submit" style="display:none">{{ __('labels.frontend.auth.otp_verfied') }} & {{ __('labels.frontend.auth.next') }}</button>
                                                </div>


                                                <div aria-live="assertive" role="alert" aria-atomic="true"
                                                    aria-label="This field is required.">

                                                </div>

                                                <div aria-live="assertive" role="alert" aria-atomic="true"
                                                    aria-label="false">
                                                    <div class="form-group__msg margin-t-s txt-c" style="display: none;">
                                                        <span class="color-error xsmall txt-c font-semibold"
                                                            style="display: none;">This field is required.</span>
                                                        <span class="color-error xsmall txt-c font-semibold"></span>

                                                    </div>
                                                </div>
                                            </form>
                                            @endif
                                            </div>
                                        </div>



                                    </div>
                                    <small keyname="landing.banner.terms"
                                        class="font-smallest tnc block margin-t-l term-cond">By proceeding, you agree to
                                        our <a href="" class="txt-underline" target="_blank">Terms of Use</a> &amp; <a
                                            href="" class="txt-underline" target="_blank">Privacy Policy</a>. Message
                                        and data rates may apply. </small>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        
    </div>
</div>





@push('after-scripts')
<script>
    $(function() {
        
                $('.request-otp').click(function(e) {
                  e.preventDefault();
  
                  // Get the phone number and OTP
                  var phone = $('#phone-number').val();
                //   var otp = $('#otp').val();

                  console.log(phone);
                //   console.log(phone);
                    $.ajax({
                      type: 'POST',
                      url: "{{ route('frontend.auth.send.otp') }}", 
                      data: {_token:"{{ csrf_token() }}",mobile_no:phone},
                      success: function(response) {
                        response = JSON.parse(response);
                              console.log(response.otp);
                              if (response.error) {
                                
                              }
                              $('.otp-box').show(); 
                              
                              $('.genrated-otp').text(response.otp); 
                              $('.request-otp').hide(); 
                              $('.register-submit').show(); 
                                                         
                          }
                      });
                });
                $('.register-submit').click(function(e) {
                  e.preventDefault();
  
                  // Get the phone number and OTP
                  var phone = $('#phone-number').val();
                  var otp = $('#otp').val();

                  console.log(phone);
                //   console.log(phone);
                    $.ajax({
                      type: 'POST',
                      url: "{{ route('frontend.auth.verify.otp') }}", 
                      data: {_token:"{{ csrf_token() }}",mobile_no:phone,otp:otp},
                      success: function(response) {
                        console.log(response);
                        console.log(response.link);
                        response = JSON.parse(response);
                              console.log(response);
                              if (response.error) {
                                
                              }
                              window.location.reload();
                              $('.otp-box').show(); 
                              
                              $('.genrated-otp').text(response.otp); 
                              $('.request-otp').hide(); 
                              $('.register-submit').show(); 
                                                         
                          }
                      });
                });
        




    });

                
</script>
    @if (config('access.captcha.registration'))
        @captchaScripts
    @endif
@endpush