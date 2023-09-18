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
                {{ Form::label('brand_name', trans('validation.attributes.backend.access.drugs.brand_images'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                   
                <div class="files-wrapper">
                @if(isset($drug))
                @if(isset($drug->images))
              
                @foreach($drug->images as $images)
                <div class="file-upload img-thumb-wrapper-{{$images->id}}">
                        <div class="file-select file-select-box">
                            <div class="imagePreview" style="background-image: url({{asset($images->image)}});z-index:2"></div>
                            <!-- <button class="file-upload-custom-btn" type="button"><i class="fa fa-plus"></i></button> -->
                            <!-- <input type="file" name="files[]" class="profileimg"> -->
                            
                        </div>
                        <button class="file-close-custom-btn-edit" type="button" onclick="remove_image({{$images->id}})"><i class="fa fa-close"></i></button>
                    </div>
                    @endforeach
                @endif  
                @else
                <div class="file-upload">
                        <div class="file-select file-select-box">
                            <div class="imagePreview"></div>
                            <!-- <button class="file-upload-custom-btn" type="button"><i class="fa fa-plus"></i></button> -->
                            <input type="file" name="files[]" class="profileimg">
                        </div>
                    </div> 
                @endif   
                    
                </div>
                <button type="button" class="add-more btn btn-success" onclick="add_more()"> Add More</button>
                
                
                
              
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
<style>
.imagePreview{
    width: 90px;
    height: 90px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin-right: 0;
    position: absolute;
    background-color: #fff;
    top: 0;
    left: 0;
}
.file-upload{
    display: inline-block;
}

.file-select {
  position: relative;
  overflow: hidden;
  display: flex;
  align-items: center;
}
.file-select.file-select-box {
    width: 90px;
    height: 90px;
    display: inline-block;
    border-radius: 14px;
}
.file-upload-custom-btn {
    width: 90px;
    height: 90px;
    border: none;
    background-color: #ed192412;
    color: #ed1924;
    font-size: 30px;
    z-index: 1;
    position: relative;
}
.file-select-name{
    margin-left: 15px;
}
.file-select input[type=file] {
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
  width: 100%;
  height: 100%;
}

.file-select.file-select-box input[type=file]{
    z-index: 2;
}

.file-upload + .file-upload{
    margin-left: 10px;
}
    </style>

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

        $(document).ready(function() {
            $(document).on('change', '.file-upload input[type="file"]', function() {
				var filename = $(this).val();
				if (/^\s*$/.test(filename)) {
						$(this).parents(".file-upload").removeClass('active');
						$(this).parents(".file-upload").find(".file-select-name").text("No file chosen...");
				} else {
						$(this).parents(".file-upload").addClass('active');
						$(this).parents(".file-upload").find(".file-select-name").text(filename.substring(filename.lastIndexOf("\\") + 1, filename.length));
				}
				var uploadFile = $(this);
				var files = !!this.files ? this.files : [];
				if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

				if (/^image/.test(files[0].type)) { // only image file
						var reader = new FileReader(); // instance of the FileReader
						reader.readAsDataURL(files[0]); // read the local file

						reader.onloadend = function() { // set image data as background of div
								uploadFile.closest(".file-upload").find('.imagePreview').css({"background-image": "url(" + this.result + ")", "z-index": "2"});
								uploadFile.closest(".file-upload").find('.file-select').append('<span class="close"><i class="fas fa-close"></i></span>');
						}
				}
		});
        });
        function removeFileFromFileList(index) {
            console.log(index);
            const dt = new DataTransfer()
            const input = document.getElementById('drugfilesUpload')
            const { files } = input
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i]
                if (index !== i)

                dt.items.add(file) // here you exclude the file. thus removing it.
            }
            
            input.files = dt.files // Assign the updates list
            }
        function remove_image(id)
        {
           // alert(id);
           $("#overlay").fadeIn(300);
            var ajaxurl = '{{route('admin.drugs.image.remove', ':id')}}';
            ajaxurl = ajaxurl.replace(':id', id);
            $.ajax({
                url: ajaxurl,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $(".img-thumb-wrapper-"+id).remove();
                    console.log(data);
                }
            }).done(function() {
            setTimeout(function(){
                $("#overlay").fadeOut(300);
            },500);
            });
        }
        
        function add_more() {
            // files-wrapper
            var numItems = $('.file-upload').length;
            console.log(numItems);
            var html = '';
            html += '<div class="file-upload '+numItems+'">';
            html += '<div class="file-select file-select-box">';
            html += '<div class="imagePreview"></div>';
            html += '<button class="file-upload-custom-btn" type="button"><i class="fa fa-plus"></i></button>';
            html += '<input type="file" name="files[]" class="profileimg">';
            html += '</div>';  
            html += '<button class="file-close-custom-btn" type="button"><i class="fa fa-close"></i></button>';  
            html += '</div>';
            $(".files-wrapper").append(html);
            }
            function delete_file() {
              
                $(this).closest('.file-upload').remove();
            }
            $(document).on("click", ".file-close-custom-btn", function(e) {
                e.preventdefault;
                $(this).closest('.file-upload').remove();
                });
            
    </script>
@stop
