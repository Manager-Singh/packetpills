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
	</style>
@endpush

@section('content')
    <div class="row justify-content-center" style="margin-top: 105px;">
        <div class="col col-sm-8 align-self-center">
            <div class="card">
                <div class="card-header">
                    <strong>
                        @lang('labels.frontend.connect.box_title')
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    {{ html()->form('POST', route('frontend.enterprise.connect.submit'))->open() }}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.name'))->for('full_name') }}

                                    {{ html()->text('full_name', optional(auth()->user())->name)
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.name'))
                                        ->attribute('maxlength', 191)
                                        ->required()
                                        ->autofocus() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.company'))->for('company') }}

                                    {{ html()->text('company')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.company'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.job_title'))->for('job_title') }}

                                    {{ html()->text('job_title')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.job_title'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                    {{ html()->email('email', optional(auth()->user())->email)
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.phone'))->for('phone_no') }}

                                    {{ html()->text('phone_no')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.phone'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        @if(config('access.captcha.contact'))
                            <div class="row">
                                <div class="col">
                                    @captcha
                                    {{ html()->hidden('captcha_status', 'true') }}
                                </div><!--col-->
                            </div><!--row-->
                        @endif

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    {{ form_submit(__('labels.frontend.contact.button')) }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                    {{ html()->form()->close() }}
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection

@push('after-scripts')
    @if(config('access.captcha.contact'))
        @captchaScripts
    @endif
@endpush