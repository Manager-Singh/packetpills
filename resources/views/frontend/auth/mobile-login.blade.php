<div class="row justify-content-center align-items-center">
        <div class="col col-sm-8 align-self-center">
            <div class="card">
               

                <div class="card-body">
                  {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.mobileno'))->for('mobile_no') }}

                                    {{ html()->number('mobile_no')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.mobileno'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col">
                                <div class="form-group clearfix">
                                    {{ form_submit(__('labels.frontend.auth.get_started')) }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        @if(config('access.captcha.login'))
                            <div class="row">
                                <div class="col">
                                    @captcha
                                    {{ html()->hidden('captcha_status', 'true') }}
                                </div><!--col-->
                            </div><!--row-->
                        @endif

                       <!-- <div class="row">
                            <div class="col">
                                <div class="form-group text-right">
                                    <a href="{{ route('frontend.auth.password.reset') }}">@lang('labels.frontend.passwords.forgot_password')</a>
                                </div>
                            </div>
                        </div> -->
                    {{ html()->form()->close() }}

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
                    @if(config('access.captcha.registration'))
                        @captchaScripts
                    @endif
                @endpush
