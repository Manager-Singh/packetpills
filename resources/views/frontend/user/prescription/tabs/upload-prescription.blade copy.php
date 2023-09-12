
@extends('frontend.layouts.website')

@section('content')
    <div class="row justify-content-center align-items-center mb-3 main-top-c">
        <div class="col col-sm-10 align-self-center">
            <div class="card">
                <div class="card-header">
                    <strong>
                        @lang('navs.frontend.user.prescription.take_a_picture_of_your')
                    </strong>
                </div>

                <div class="card-body">
                {{ html()->modelForm($logged_in_user, 'POST', route('frontend.user.prescription.upload.save'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
                    @method('POST')

                    <div class="row">
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        {{ html()->label(__('validation.attributes.frontend.prescription.field_lable'))->for('avatar') }}
                                        (Page 1)
                                        
                                    </div><!--form-group-->

                                    <div class="form-group " id="">
                                        {{ html()->file('prescription_upload')->attribute('name', 'prescription_upload[]')->class('form-control-file') }}
                                    </div><!--form-group-->

                                </div>
                            </div><!--card-->
                        </div><!--col-->
                        <div class="col-3">

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        {{ html()->label(__('validation.attributes.frontend.prescription.field_lable'))->for('avatar') }}
                                        (Page 2)
                                        
                                    </div><!--form-group-->

                                    <div class="form-group " id="">
                                    {{ html()->file('prescription_upload')->attribute('name', 'prescription_upload[]')->class('form-control-file') }}
                                    </div><!--form-group-->

                                </div>
                            </div><!--card-->

                        </div><!--col-->
                        <div class="col-3">

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        {{ html()->label(__('validation.attributes.frontend.prescription.field_lable'))->for('avatar') }}
                                        (Page 3)
                                        
                                    </div><!--form-group-->

                                    <div class="form-group " id="">
                                    {{ html()->file('prescription_upload')->attribute('name', 'prescription_upload[]')->class('form-control-file') }}
                                    </div><!--form-group-->

                                </div>
                            </div><!--card-->

                        </div><!--col-->
                        <div class="col-3">

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        {{ html()->label(__('validation.attributes.frontend.prescription.field_lable'))->for('avatar') }}
                                        (Page 4)
                                        
                                    </div><!--form-group-->

                                    <div class="form-group " id="">
                                    {{ html()->file('prescription_upload')->attribute('name', 'prescription_upload[]')->class('form-control-file') }}
                                    </div><!--form-group-->

                                </div>
                            </div><!--card-->

                        </div><!--col-->
                    </div><!--row-->

   
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0 clearfix">
                            {{ form_submit(__('labels.general.buttons.save')) }}
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->     
                {{ html()->closeModelForm() }}
                </div><!--card body-->
            </div><!-- card -->
        </div><!-- col-xs-12 -->
    </div><!-- row -->
@endsection








@push('after-scripts')
    <script>
        $(function() {
            var avatar_location = $("#avatar_location");

           

           
        });
    </script>
@endpush
