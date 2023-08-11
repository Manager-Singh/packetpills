<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                {{ __('labels.backend.access.drugs.management') }}
                <small class="text-muted">{{ (isset($blog)) ? __('labels.backend.access.drugs.edit') : __('labels.backend.access.drugs.create') }}</small>
            </h4>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <hr>

    <div class="row mt-4 mb-4">
        <div class="col">
            <div class="form-group row">
                {{ Form::label('name', trans('validation.attributes.backend.access.drugs.name'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.name') ]) }}
                </div>
                <!--col-->
            </div>
            <div class="form-group row">
                {{ Form::label('available_form', trans('validation.attributes.backend.access.drugs.available_form'), ['class' => 'col-md-2 from-control-label']) }}

                <div class="col-md-10">
                    {{ Form::text('available_form', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.available_form')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('generic_name', trans('validation.attributes.backend.access.drugs.generic_name'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('generic_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.generic_name') ]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('manufacturer_name', trans('validation.attributes.backend.access.drugs.manufacturer_name'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('manufacturer_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.manufacturer_name') ]) }}
                </div>
                <!--col-->
            </div>

            
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('strength', trans('validation.attributes.backend.access.drugs.strength'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('strength', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.strength') ]) }}
                </div>
                <!--col-->
            </div>

            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('description', trans('validation.attributes.backend.access.drugs.description'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.description')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('faq', trans('validation.attributes.backend.access.drugs.faq'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('faq', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.faq')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('how_to_take', trans('validation.attributes.backend.access.drugs.how_to_take'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('how_to_take', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.how_to_take')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('dosage', trans('validation.attributes.backend.access.drugs.dosage'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('dosage', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.dosage')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('side_effect', trans('validation.attributes.backend.access.drugs.side_effect'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('side_effect', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.side_effect')]) }}
                </div>
                <!--col-->
            </div>

            
            
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('available_form_description', trans('validation.attributes.backend.access.drugs.available_form_description'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('available_form_description', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.available_form_description')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('contraindications', trans('validation.attributes.backend.access.drugs.contraindications'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('contraindications', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.contraindications')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('precautions', trans('validation.attributes.backend.access.drugs.precautions'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('precautions', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.precautions')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('warnings', trans('validation.attributes.backend.access.drugs.warnings'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('warnings', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.warnings')]) }}
                </div>
                <!--col-->
            </div>
            
            
            
            
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('status', trans('validation.attributes.backend.access.drugs.status'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::select('status', $status, null, ['class' => 'form-control select2 status box-size', 'placeholder' => trans('validation.attributes.backend.access.drugs.status') ]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
        </div>
        <!--col-->
    </div>
    <!--row-->
</div>
<!--card-body-->

@section('pagescript')
<script type="text/javascript">
    FTX.Utils.documentReady(function() {
        console.log(FTX);
        FTX.Drugs.edit.init("{{ config('locale.languages.' . app()->getLocale())[1] }}");
    });
</script>
@stop