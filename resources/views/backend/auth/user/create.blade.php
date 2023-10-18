@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.create'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.auth.user.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => true]) }}
    @php
        //print_r($provinces);
    @endphp
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.users.management')
                        <small class="text-muted">@lang('labels.backend.access.users.create')</small>
                    </h4>
                </div>
                <!--col-->
            </div>
            <!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ Form::label('first_name', __('validation.attributes.backend.access.users.first_name'), ['class' => 'col-md-2 form-control-label']) }}

                        <div class="col-md-10">
                            {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.first_name'), 'required' => 'required']) }}
                        </div>
                        <!--col-->
                    </div>
                    <!--form-group-->

                    <div class="form-group row">
                        {{ Form::label('last_name', __('validation.attributes.backend.access.users.last_name'), ['class' => 'col-md-2 form-control-label']) }}

                        <div class="col-md-10">
                            {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.last_name'), 'required' => 'required']) }}
                        </div>
                        <!--col-->
                    </div>
                    <!--form-group-->
                    <!--image avtaar-->
                    <div class="form-group row">
                      
                        <label class="col-md-2" for="avatar">Avatar </label>

                        <div class="col-md-10" id="avatar_location">
                            <input class="form-control-file" type="file" name="avatar_location" id="avatar_location">
                        </div><!--form-group-->
                        
                    </div>
                    <!--image avtaar end-->
                    <div class="form-group row">
                        {{ Form::label('email', __('validation.attributes.backend.access.users.email'), ['class' => 'col-md-2 form-control-label']) }}

                        <div class="col-md-10">
                            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.email'), 'required' => 'required']) }}
                        </div>
                        <!--col-->
                    </div>
                    <!--form-group-->
                    <div class="form-group row">
                        {{ Form::label('mobile_no', __('validation.attributes.backend.access.users.mobile_no'), ['class' => 'col-md-2 form-control-label']) }}

                        <div class="col-md-10">
                            {{ Form::text('mobile_no', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.mobile_no'), 'required' => 'required']) }}
                        </div>
                        <!--col-->
                    </div>
                    <!--form-group-->

                    <div class="form-group row">
                        {{ Form::label('password', __('validation.attributes.backend.access.users.password'), ['class' => 'col-md-2 form-control-label']) }}

                        <div class="col-md-10">
                            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.password'), 'required' => 'required']) }}
                        </div>
                        <!--col-->
                    </div>
                    <!--form-group-->


                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.password_confirmation'))->class('col-md-2 form-control-label')->for('password_confirmation') }}

                        <div class="col-md-10">
                            {{ html()->password('password_confirmation')->class('form-control')->placeholder(__('validation.attributes.backend.access.users.password_confirmation'))->required() }}
                        </div>
                        <!--col-->
                    </div>
                    <!--form-group-->
                    <div class="form-group row">
                        {{ Form::label('gender', trans('validation.attributes.backend.access.users.gender'), ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            <label for="gender-male" class="control">
                                <input type="radio" value="male" name="gender" id="gender-male" class="gender" checked/>
                                &nbsp;&nbsp;@lang('validation.attributes.backend.access.users.male')
                            </label>
                            <label for="gender-female" class="control">
                                <input type="radio" value="female" name="gender" id="gender-female" class="gender" />
                                &nbsp;&nbsp;@lang('validation.attributes.backend.access.users.female')
                            </label>
                            <label for="gender-other" class="control">
                                <input type="radio" value="Prefer To Not Share" name="gender" id="gender-other" class="gender" />
                                &nbsp;&nbsp;@lang('Prefer To Not Share')
                            </label>
                        </div>
                    </div>
                    <!--form-group-->
                    <div class="form-group row">
                        {{ Form::label('date_of_birth', __('validation.attributes.backend.access.users.d_o_b'), ['class' => 'col-md-2 form-control-label']) }}
                        <div class="col-md-10">
                            <div class="input-group date">
                                <input class="form-control" id="datepicker" name="date_of_birth"
                                    data-date-format="YYYY-MM-DD" value="YYYY-MM-DD" type="text" readonly />
                            </div>
                        </div>
                        <!--col-->
                    </div>

                    <div class="form-group row">
                        {{ Form::label('province', trans('validation.attributes.backend.access.users.province'), ['class' => 'col-md-2 from-control-label required']) }}

                        <div class="col-md-10">
                            {{ Form::select('province', $provinces, null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.users.province')]) }}
                        </div>
                        <!--col-->
                    </div>

                    <div class="form-group row">
                        {{ Form::label('prescription_images', trans('Prescription Images'), ['class' => 'col-md-2 from-control-label required']) }}

                        <div class="col-md-10">

                            <div class="files-wrapper">

                                <div class="file-upload prescription_images">
                                    <div class="file-select file-select-box">
                                        <div class="imagePreview"></div>
                                        <button class="file-upload-custom-btn" type="button"><i
                                                class="fa fa-plus"></i></button>
                                        <input type="file" name="files[]" class="profileimg">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="add-more btn btn-success" onclick="add_more()"> Add More</button>

                        </div>
                        <!--col-->
                    </div>
                    <!--form-group-->

                    <div class="form-group row">
                        {{ Form::label('status', trans('validation.attributes.backend.access.users.active'), ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::checkbox('status', '1', true) }}
                        </div>
                    </div>
                    <!--form control-->

                    <div class="form-group row">
                        {{ Form::label('confirmed', trans('validation.attributes.backend.access.users.confirmed'), ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::checkbox('confirmed', '1', true) }}
                        </div>
                    </div>
                    <!--form control-->



                    @if (!config('access.users.requires_approval'))
                        <div class="form-group row">
                            <label
                                class="col-md-2 control-label">{{ trans('validation.attributes.backend.access.users.send_confirmation_email') }}<br />
                                <small>{{ trans('strings.backend.access.users.if_confirmed_off') }}</small>
                            </label>

                            <div class="col-md-10">
                                {{ Form::checkbox('confirmation_email', '1') }}
                            </div>
                            <!--col-lg-1-->
                        </div>
                        <!--form control-->
                    @endif

                    <div class="form-group row">
                        {{ Form::label('status', trans('validation.attributes.backend.access.users.associated_roles'), ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            @if (count($roles) > 0)
                                @foreach ($roles as $role)
                                    <label for="role-{{ $role->id }}" class="control">
                                        <input type="radio" value="{{ $role->id }}" name="assignees_roles[]"
                                            {{ $role->id == 3 ? 'checked' : '' }} id="role-{{ $role->id }}"
                                            class="get-role-for-permissions" /> &nbsp;&nbsp;{!! $role->name !!}
                                    </label>
                                    <!--permission list-->
                                @endforeach
                            @else
                                {{ trans('labels.backend.access.users.no_roles') }}
                            @endif
                        </div>
                    </div>
                    <!--form-group-->

                    <div class="form-group row">
                        {{ Form::label('associated-permissions', trans('validation.attributes.backend.access.roles.associated_permissions'), ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-10 search-permission">
                            <div id="available-permissions">
                                <div>
                                    <input type="text" class="form-control search-button" placeholder="Search..." />
                                </div>
                                <div class="get-available-permissions">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--col-->
            </div>
            <!--row-->
        </div>
        <!--card-body-->

        @include('backend.components.footer-buttons', ['cancelRoute' => 'admin.auth.user.index'])
    </div>
    <!--card-->
    {{ Form::close() }}
@endsection
@push('after-styles')
    <style>
        .imagePreview {
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

        .file-upload {
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
            box-shadow: 0px 0px 5px 0px #44434347;
        }

        .file-upload-custom-btn {
            width: 90px;
            height: 90px;
            border: none;
            background-color: #5bc3272b;
            color: #289b54;
            font-size: 30px;
            z-index: 1;
            position: relative;
        }

        .file-select-name {
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

        .file-select.file-select-box input[type=file] {
            z-index: 2;
        }

        .file-upload+.file-upload {
            margin-left: 10px;
        }

        .file-upload {
            position: relative;
        }

        button.file-close-custom-btn,
        button.file-close-custom-btn-edit {
            position: absolute;
            right: -6px;
            top: -6px;
            border: 1px;
            border-radius: 100px;
            color: red;
            background: #ff00002b;
            z-index: 2;
        }
    </style>
@endpush
@section('pagescript')
    <script>
        FTX.Utils.documentReady(function() {
            FTX.Users.edit.selectors.getPremissionURL = "{{ route('admin.get.permission') }}";
            FTX.Users.edit.init("create");
        });
        $(function() {
            $("#datepicker").datepicker({
                autoclose: true,
                todayHighlight: true,
                format: "yyyy-mm-dd",
            });
        });


        $(document).ready(function() {
            $(document).on('change', '.file-upload input[type="file"]', function() {
                var filename = $(this).val();
                if (/^\s*$/.test(filename)) {
                    $(this).parents(".file-upload").removeClass('active');
                    $(this).parents(".file-upload").find(".file-select-name").text("No file chosen...");
                } else {
                    $(this).parents(".file-upload").addClass('active');
                    $(this).parents(".file-upload").find(".file-select-name").text(filename.substring(
                        filename.lastIndexOf("\\") + 1, filename.length));
                }
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader)
            return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function() { // set image data as background of div
                        uploadFile.closest(".file-upload").find('.imagePreview').css({
                            "background-image": "url(" + this.result + ")",
                            "z-index": "2"
                        });
                        uploadFile.closest(".file-upload").find('.file-select').append(
                            '<span class="close"><i class="fas fa-close"></i></span>');
                    }
                }
            });
        });

        function removeFileFromFileList(index) {
            console.log(index);
            const dt = new DataTransfer()
            const input = document.getElementById('drugfilesUpload')
            const {
                files
            } = input

            for (let i = 0; i < files.length; i++) {
                const file = files[i]
                if (index !== i)

                    dt.items.add(file) // here you exclude the file. thus removing it.
            }

            input.files = dt.files // Assign the updates list
        }

        function remove_image(id) {
            // alert(id);
            $("#overlay").fadeIn(300);
            var ajaxurl = '{{ route('admin.drugs.image.remove', ':id') }}';
            ajaxurl = ajaxurl.replace(':id', id);
            $.ajax({
                url: ajaxurl,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $(".img-thumb-wrapper-" + id).remove();
                    console.log(data);
                }
            }).done(function() {
                setTimeout(function() {
                    $("#overlay").fadeOut(300);
                }, 500);
            });
        }

        function add_more() {
            // files-wrapper
            $("#overlay").fadeIn(300);
            var numItems = $('.file-upload').length;
            if (numItems >= 8) {
                alert('You only add eight Images');
                $("#overlay").fadeOut(300);
                return false;
            }
            console.log(numItems);
            var html = '';
            html += '<div class="file-upload ' + numItems + '">';
            html += '<div class="file-select file-select-box">';
            html += '<div class="imagePreview"></div>';
            html += '<button class="file-upload-custom-btn" type="button"><i class="fa fa-plus"></i></button>';
            html += '<input type="file" name="files[]" class="profileimg">';
            html += '</div>';
            html += '<button class="file-close-custom-btn" type="button"><i class="fa fa-close"></i></button>';
            html += '</div>';
            $(".files-wrapper").append(html);
            $("#overlay").fadeOut(300);

        }

        function delete_file() {

            $(this).closest('.file-upload').remove();
        }

        $(document).on("click", ".file-close-custom-btn", function(e) {
            e.preventdefault;
            $(this).closest('.file-upload').remove();
        });
    </script>
@endsection
