<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                {{ __('labels.backend.access.drugs.management') }}
                <small
                    class="text-muted">{{ isset($blog) ? __('labels.backend.access.drugs.edit') : __('labels.backend.access.drugs.create') }}</small>
            </h4>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <hr>

    <div class="row mt-4 mb-4">
        <div class="col">
            <div class="form-group row">
                {{ Form::label('brand_name', trans('validation.attributes.backend.access.drugs.brand_name'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('brand_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.brand_name')]) }}
                </div>
                <!--col-->
            </div>
            <div class="form-group row">
                {{ Form::label('manufacturer', trans('validation.attributes.backend.access.drugs.manufacturer'), ['class' => 'col-md-2 from-control-label']) }}

                <div class="col-md-10">
                    {{ Form::text('manufacturer', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.manufacturer')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('generic_name', trans('validation.attributes.backend.access.drugs.generic_name'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('generic_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.generic_name')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('main_therapeutic_use', trans('validation.attributes.backend.access.drugs.main_therapeutic_use'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('main_therapeutic_use', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.main_therapeutic_use')]) }}
                </div>
                <!--col-->
            </div>

            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('strength', trans('validation.attributes.backend.access.drugs.strength'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::text('strength', null, ['class' => 'form-control ', 'placeholder' => trans('validation.attributes.backend.access.drugs.strength')]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::select('strength_unit', $strength_unit, null, ['class' => 'form-control select2 status box-size', 'placeholder' => trans('validation.attributes.backend.access.drugs.strength_unit')]) }}
                        </div>
                    </div>
                </div>
                <!--col-->
            </div>

            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('format', trans('validation.attributes.backend.access.drugs.format'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::select('format', $formats, null, ['class' => 'form-control select2 status box-size', 'placeholder' => trans('validation.attributes.backend.access.drugs.format')]) }}
                </div>
                <!--col-->
            </div>

            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('manufacturer', trans('validation.attributes.backend.access.drugs.manufacturer'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('manufacturer', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.manufacturer')]) }}
                </div>
                <!--col-->
            </div>

            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('pack_size', trans('validation.attributes.backend.access.drugs.pack_size'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::text('pack_size', null, ['class' => 'form-control ', 'placeholder' => trans('validation.attributes.backend.access.drugs.pack_size')]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::select('pack_unit', $pack_unit, null, ['class' => 'form-control select2 status box-size', 'placeholder' => trans('validation.attributes.backend.access.drugs.pack_unit')]) }}
                        </div>
                    </div>
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('din', trans('validation.attributes.backend.access.drugs.din'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('din', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.din')]) }}
                </div>
                <!--col-->
            </div>

            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('preciption_types', trans('validation.attributes.backend.access.drugs.presciption_required'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::select('preciption_types_id', $preciption_types_id, null, ['class' => 'form-control select2 status box-size', 'placeholder' => trans('validation.attributes.backend.access.drugs.presciption_required')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('upc', trans('validation.attributes.backend.access.drugs.upc'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('upc', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.upc')]) }}
                </div>
                <!--col-->
            </div>

            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('pharmacy_purchase_price', trans('validation.attributes.backend.access.drugs.pharmacy_purchase_price'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('pharmacy_purchase_price', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.pharmacy_purchase_price')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('percent_markup', trans('validation.attributes.backend.access.drugs.percent_markup'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('percent_markup', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.percent_markup')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('dispensing_fee', trans('validation.attributes.backend.access.drugs.dispensing_fee'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('dispensing_fee', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.dispensing_fee')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('insurance_coverage_in_percent', trans('validation.attributes.backend.access.drugs.insurance_coverage_in_percent'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::select('insurance_coverage_in_percent', $insurance_coverage_in_percent, null, ['class' => 'form-control select2 status box-size', 'placeholder' => trans('validation.attributes.backend.access.drugs.insurance_coverage_in_percent')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <!--form-group-->
            <div class="form-group row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::label('drug_indication', trans('validation.attributes.backend.access.drugs.drug_indication'), ['class' => 'from-control-label required']) }}
                            {{ Form::textarea('drug_indication', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.drug_indication')]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('standard_dosage', trans('validation.attributes.backend.access.drugs.standard_dosage'), ['class' => 'from-control-label required']) }}
                            {{ Form::textarea('standard_dosage', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.standard_dosage')]) }}
                        </div>
                    </div>
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::label('side_effect', trans('validation.attributes.backend.access.drugs.side_effect'), ['class' => 'from-control-label required']) }}
                            {{ Form::textarea('side_effect', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.side_effect')]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('contraindications_precautions_warnings', trans('validation.attributes.backend.access.drugs.contraindications_precautions_warnings'), ['class' => 'from-control-label required']) }}
                            {{ Form::textarea('contraindications_precautions_warnings', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.contraindications_precautions_warnings')]) }}
                        </div>
                    </div>
                </div>
                <!--col-->
            </div>

            <!--form-group-->


            <div class="form-group row">
                {{ Form::label('status', trans('validation.attributes.backend.access.drugs.status'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::select('status', $status, null, ['class' => 'form-control select2 status box-size', 'placeholder' => trans('validation.attributes.backend.access.drugs.status')]) }}
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
    <script>
        $(document).ready(function() {
            var max_fields = 5; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID
            var x = 1; //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(
                        '<div class="form-group col-md-7 d-flex align-items-center"><div class="strength"><input type="text" name="strength[]" placeholder="Strength" value="" class="form-control"></div><div class="price"><input type="text" name="price[]" placeholder="Price" value="" class="form-control"></div><div class="remove"><div style="cursor:pointer;background-color:red;" class="remove_field btn btn-info">Remove</div></div></div>'
                        ).fadeIn('slow');
                }
            });
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parent().parent('div').fadeOut("slow", function() {
                    $(this).remove();
                });
                //$(this).parent().parent('div').remove();
                x--;
            })
        });
    </script>
    <script type="text/javascript">
        FTX.Utils.documentReady(function() {
            console.log(FTX);
            FTX.Drugs.edit.init("{{ config('locale.languages.' . app()->getLocale())[1] }}");
        });
    </script>
@stop
