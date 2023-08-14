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
            <?php
                if(isset($drug)){

                    $strength = unserialize($drug->strength);
                    $price = unserialize($drug->price);
                }

            ?>

            <!--form-group-->
            <div class="form-group row">
                {{ Form::label('strength', trans('validation.attributes.backend.access.drugs.strength'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    <!-- {{ Form::text('strength', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.drugs.strength') ]) }} -->
                    <div class="form-row input_fields_wrap">
                        <div class="form-group col-md-7 d-flex align-items-center">
                            <div class="strength">
                                <input type="text" name="strength[]" placeholder="Strength" value="{{(isset($strength)) ? $strength[0] : '' }}" class="form-control">
                            </div>
                            <div class="price">
                                <input type="text" name="price[]" placeholder="Price" value="{{(isset($price)) ? $price[0] : '' }}" class="form-control">
                            </div>
                            <div class="remove">
                                <button type="button" class="btn btn-info btn-sm pull-right add_field_button">Add</button>
                            </div>
                        </div>
                    @if(isset($drug) && isset($strength) && isset($price))
                        @php
                        unset($strength[0]);
                        unset($price[0]);

                        @endphp
                        @if(count($strength) > 0)
                        @foreach($strength as $key=>$steng)
                        <div class="form-group col-md-7 d-flex align-items-center">
                            <div class="strength">
                                <input type="text" name="strength[]" placeholder="Strength" value="{{$steng}}" class="form-control">
                            </div>
                            <div class="price">
                                <input type="text" name="price[]" placeholder="Price" value="{{$price[$key]}}" class="form-control">
                            </div>
                            <div class="remove">
                                    <div style="cursor:pointer;background-color:red;" class="remove_field btn btn-info">Remove</div>
                                </div>
                            </div>
                        @endforeach
                        @endif

                    @endif

                    </div>
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
                  $(wrapper).append('<div class="form-group col-md-7 d-flex align-items-center"><div class="strength"><input type="text" name="strength[]" placeholder="Strength" value="" class="form-control"></div><div class="price"><input type="text" name="price[]" placeholder="Price" value="" class="form-control"></div><div class="remove"><div style="cursor:pointer;background-color:red;" class="remove_field btn btn-info">Remove</div></div></div>').fadeIn('slow');
                  }
                }); $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parent().parent('div').fadeOut( "slow", function() {
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
