<div class="row justify-content-center align-items-center">
    <div class="col col-sm-8 align-self-center">
        <div class="card">


            <div class="card-body">
                {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.mobileno'))->for('mobile_no') }}

                            {{ html()->number('mobile_no')->class('form-control')->attribute('id','phone-number')->placeholder(__('validation.attributes.frontend.mobileno'))->attribute('maxlength', 191)->required() }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
                <div class="row">
                    <div class="col otp-box hide" style="display:none;">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.otp'))->for('otp') }}

                            {{ html()->text('otp')->class('form-control')->placeholder(__('validation.attributes.frontend.otp'))->attribute('id','otp')->attribute('maxlength', 6)->attribute('minlength', 6)->required() }}
                            <span class="genrated-otp"></span>
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->

                <div class="row">
                    <div class="col">
                        <div class="form-group clearfix">
                            <!-- {{ form_submit(__('labels.frontend.auth.get_started')) }} -->
                            <button type="button" class="request-otp">{{ __('labels.frontend.auth.get_started') }}</button>
                            <button type="button" class="register-submit" style="display:none">{{ __('labels.frontend.auth.get_started') }}</button>
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
                @if (config('access.captcha.login'))
                    <div class="row">
                        <div class="col">
                            @captcha
                            {{ html()->hidden('captcha_status', 'true') }}
                        </div><!--col-->
                    </div><!--row-->
                @endif
                {{ html()->form()->close() }}
                <!-- </form> -->

                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            @include('frontend.auth.includes.socialite')
                        </div>
                    </div><!--col-->
                </div><!--row-->
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
<script>
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
                              console.log(response.otp);
                              if (response.error==0) {
                                if(response.route=='dashboard'){
                                    // window.location.replace('/'+response.route);
                                    window.location = "/"+response.route;
                                }
                                // $('.otp-box').show();
                              }
                            //   $('.otp-box').show();

                            //   $('.genrated-otp').text(response.otp);
                            //   $('.request-otp').hide();
                            //   $('.register-submit').show();

                          }
                      });
                });


</script>
    @if (config('access.captcha.registration'))
        @captchaScripts
    @endif
@endpush
