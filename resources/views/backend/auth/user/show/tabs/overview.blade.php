<div class="row">
    <div class="col-md-4">
        <h4 class="text-center">Basic Details</h4>
        <div class="table-responsive">
            <table class="table table-hover" style="border: 1px solid #c8ced3;">
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.avatar')</th>
                    <td><img src="{{ $user->picture }}" class="user-profile-image" /></td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.first_name')</th>
                    <td>{{ $user->first_name }}</td>
                </tr>
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.last_name')</th>
                    <td>{{ $user->last_name }}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.email')</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>@lang('validation.attributes.backend.access.users.mobile_no')</th>
                    <td>
                        @if ($user->mobile_no)
                            <a href="tel:{{ $user->mobile_no }}">+{{ $user->dialing_code }}-{{ $user->mobile_no }}</a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>@lang('validation.attributes.backend.access.users.gender')</th>
                    <td>
                        {{ ucfirst($user->gender) }}
                    </td>
                </tr>
                <tr>
                    <th>@lang('validation.attributes.backend.access.users.d_o_b')</th>
                    <td>
                        {{ ucfirst($user->date_of_birth) }}
                    </td>
                </tr>
                <tr>
                    <th>@lang('validation.attributes.backend.access.users.province')</th>
                    <td>
                        {{ ucfirst($user->province) }}
                    </td>
                </tr>
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.status')</th>
                    <td>@include('backend.auth.user.includes.status', ['user' => $user])</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.confirmed')</th>
                    <td>@include('backend.auth.user.includes.confirm', ['user' => $user])</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.timezone')</th>
                    <td>{{ $user->timezone }}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.last_login_at')</th>
                    <td>
                        @if ($user->last_login_at)
                            {{ timezone()->convertToLocal($user->last_login_at) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.last_login_ip')</th>
                    <td>{{ $user->last_login_ip ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>
    </div>
    <!--table-responsive-->
    <div class="col-md-8 blue-right-border">
        <h4 class="text-center">Prescriptions Details </h4>

        <div class="panel-group wrap" id="accordion2" role="tablist" aria-multiselectable="true">
            <div class="panel">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                            Create Prescription
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        {{ Form::open(['route' => 'admin.auth.user.create.prescription', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => true]) }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group row">
                            {{ Form::label('prescription_images', trans('Prescription Images'), ['class' => 'col-md-2 from-control-label required']) }}
                            <div class="col-md-10">
                                <div class="files-wrapper prescription-wrapper">
                                    <div class="file-upload files-wrapper-inner">
                                        <div class="file-select file-select-box">
                                            <div class="imagePreview"></div>
                                            <button class="file-upload-custom-btn" type="button"><i
                                                    class="fa fa-plus"></i></button>
                                            <input type="file" name="files[]" class="profileimg" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--col-->
                        </div>
                        <div class="card-footer-prescription">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="add-more btn btn-info"
                                        onclick="add_more('prescription-wrapper','files-wrapper-inner')"> Add
                                        More</button>
                                </div><!--col-->

                                <div class="col text-right">
                                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success pull-right']) }}
                                </div><!--row-->
                            </div><!--row-->
                        </div><!--card-footer-->
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>


        @if (count($user->prescriptions) > 0)

            <div class="panel-group wrap" id="accordion" role="tablist" aria-multiselectable="true">
                @foreach ($user->prescriptions as $key => $prescription)
                    <div class="panel">
                        <div class="panel-heading" role="tab" id="heading-{{ $prescription->id }}">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                    href="#collapse-{{ $prescription->id }}" aria-expanded="true"
                                    aria-controls="collapse-{{ $prescription->id }}">
                                    {{ $prescription->prescription_number }} Created At
                                    {{ $prescription->created_at }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-{{ $prescription->id }}" class="panel-collapse collapse in" role="tabpanel"
                            aria-labelledby="heading-{{ $prescription->id }}">
                            <div class="panel-body">
                                @if (count($prescription->prescription_iteams) > 0)
                                    <h5 class="prescription-heading">Prescription Images</h5>
                                    <div class="gallery-wrapper">
                                        @foreach ($prescription->prescription_iteams as $iteam => $prescription_iteam)
                                            <div class="image-wrapper">
                                                <a
                                                    href="#lightbox-image-{{ $prescription_iteam->prescripiton_id }}-{{ $prescription_iteam->page_no }}">
                                                    <img src="{{ asset($prescription_iteam->prescription_upload) }}"
                                                        alt="">
                                                    <div class="image-title">Prescription page No.
                                                        {{ $prescription_iteam->page_no }}
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="gallery-lightboxes">
                                        @foreach ($prescription->prescription_iteams as $iteam => $prescription_iteam_for_modal)
                                            <div class="image-lightbox"
                                                id="lightbox-image-{{ $prescription_iteam_for_modal->prescripiton_id }}-{{ $prescription_iteam_for_modal->page_no }}">
                                                <div class="image-lightbox-wrapper">
                                                    <a href="#" class="close"></a>
                                                    <!-- <a href="#lightbox-image-{{ $prescription_iteam_for_modal->page_no + 1 }}" class="arrow-left"></a>
                                                    <a href="#lightbox-image-{{ $prescription_iteam_for_modal->page_no - 1 }}" class="arrow-right"></a> -->
                                                    <img src="{{ asset($prescription_iteam->prescription_upload) }}"
                                                        alt="">
                                                    <div class="image-title">Prescription page No.
                                                        {{ $prescription_iteam_for_modal->page_no }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p>Prescription images not added!</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- end of panel -->
                @endforeach


            </div>
        @else
            <p>Prescriptions not added!</p>
        @endif
    </div>
</div>


@push('after-styles')
    <style>
        .wrap {
            box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.14), 0px 3px 1px -2px rgba(0, 0, 0, 0.2), 0px 1px 5px 0px rgba(0, 0, 0, 0.12);
            border-radius: 4px;
        }

        a:focus,
        a:hover,
        a:active {
            outline: 0;
            text-decoration: none;
        }

        .panel {
            border-width: 0 0 1px 0;
            border-style: solid;
            border-color: #fff;
            background: none;
            box-shadow: none;
        }

        .panel:last-child {
            border-bottom: none;
        }

        .panel-group>.panel:first-child .panel-heading {
            border-radius: 4px 4px 0 0;
        }

        .panel-group .panel {
            border-radius: 0;
        }

        .panel-group .panel+.panel {
            margin-top: 0;
        }

        .panel-heading {
            background-color: #009688;
            border-radius: 0;
            border: none;
            color: #fff;
            padding: 0;
        }

        .panel-title a {
            display: block;
            color: #fff;
            padding: 16px;
            position: relative;
            font-size: 16px;
            font-weight: 400;
        }

        .panel-body {
            background: #fff;
            padding: 8px 16px;
        }

        .panel:last-child .panel-body {
            border-radius: 0 0 4px 4px;
            padding: 8px 16px;
        }

        .panel:last-child .panel-heading {
            border-radius: 0 0 4px 4px;
            transition: border-radius 0.3s linear 0.2s;
        }

        .panel:last-child .panel-heading.active {
            border-radius: 0;
            transition: border-radius linear 0s;
        }

        /* #bs-collapse icon scale option */

        .panel-heading a:before {
            content: '\e146';
            position: absolute;
            font-family: 'Material Icons';
            right: 5px;
            top: 10px;
            font-size: 24px;
            transition: all 0.5s;
            transform: scale(1);
        }

        .panel-heading.active a:before {
            content: ' ';
            transition: all 0.5s;
            transform: scale(0);
        }

        #bs-collapse .panel-heading a:after {
            content: ' ';
            font-size: 24px;
            position: absolute;
            font-family: 'Material Icons';
            right: 5px;
            top: 10px;
            transform: scale(0);
            transition: all 0.5s;
        }

        #bs-collapse .panel-heading.active a:after {
            content: '\e909';
            transform: scale(1);
            transition: all 0.5s;
        }

        /* #accordion rotate icon option */

        #accordion .panel-heading a:before,
        #accordionHealthcard .panel-heading a:before,
        #accordionHealthinformation .panel-heading a:before,
        #accordionPaymentmethod .panel-heading a:before,
        #accordionAddress .panel-heading a:before,
        #accordion2 .panel-heading a:before {
            content: '\e316';
            font-size: 24px;
            position: absolute;
            font-family: 'Material Icons';
            right: 5px;
            top: 10px;
            transform: rotate(180deg);
            transition: all 0.5s;
        }

        #accordion .panel-heading.active a:before,
        #accordionHealthcard .panel-heading.active a:before,
        #accordionHealthinformation .panel-heading.active a:before,
        #accordionPaymentmethod .panel-heading.active a:before,
        #accordionAddress .panel-heading.active a:before,
        #accordion2 .panel-heading.active a:before {
            transform: rotate(0deg);
            transition: all 0.5s;
        }

        #accordion2 .panel-heading,
        #accordionAddress .panel-heading,
        #accordionHealthinformation .panel-heading,
        #accordionPaymentmethod .panel-heading,
        #accordionHealthcard .panel-heading {
            background-color: #46a9d6;
            border-radius: 0;
            border: none;
            color: #fff;
            padding: 0;
        }


        /* Light box CSS */
        .image-title {
            font-size: 18px;
            text-align: center;
            background: #009689;
            color: #fff;
        }

        .gallery-wrapper {
            max-width: 960px;
            width: 100%;
            margin: 0 auto;
            padding: 0 1em;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            grid-gap: 1em;
        }

        .gallery-wrapper .image-wrapper a {
            padding: 0.5em;
            display: block;
            width: 100%;
            text-decoration: none;
            color: #333;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            transition: all 200ms ease-in-out;
        }

        .gallery-wrapper .image-wrapper a:hover {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        .gallery-wrapper .image-wrapper a img {
            width: 100%;
        }

        .gallery-lightboxes .image-lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0ms ease-in-out;
            z-index: 9;
        }

        .gallery-lightboxes .image-lightbox:target {
            opacity: 1;
            visibility: visible;
        }

        .gallery-lightboxes .image-lightbox:target .image-lightbox-wrapper {
            opacity: 1;
            transform: scale(1, 1) translateY(0);
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper {
            transform: scale(0.95, 0.95) translateY(-30px);
            transition: opacity 500ms ease-in-out, transform 500ms ease-in-out;
            opacity: 0;
            margin: 1em auto;
            max-width: 75%;
            padding: 0.5em;
            display: inline-block;
            background: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.8);
            position: relative;
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper .close {
            width: 1.5em;
            height: 1.5em;
            background: #000;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            border-radius: 50%;
            box-shadow: 0 0 0 2px white inset, 0 0 5px rgba(0, 0, 0, 0.5);
            position: absolute;
            right: -1em;
            top: -1em;
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper .close:before {
            content: "";
            display: block;
            width: 10px;
            height: 2px;
            background: #fff;
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -1px 0 0 -5px;
            transform: rotate(-45deg);
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper .close:after {
            content: "";
            display: block;
            width: 10px;
            height: 2px;
            background: #fff;
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -1px 0 0 -5px;
            transform: rotate(45deg);
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper .arrow-left {
            position: absolute;
            top: 0;
            right: 50%;
            bottom: 0;
            left: 0;
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper .arrow-left:before {
            content: "";
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #fff;
            border-bottom: 0;
            border-right: 0;
            border-radius: 4px 0 0 0;
            position: absolute;
            top: 50%;
            right: 100%;
            cursor: pointer;
            transform: rotate(-45deg) translateY(-50%);
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper .arrow-right {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 50%;
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper .arrow-right:before {
            content: "";
            display: block;
            width: 20px;
            height: 20px;
            border: 2px solid #fff;
            border-bottom: 0;
            border-left: 0;
            border-radius: 0 4px 0 0;
            position: absolute;
            top: 50%;
            left: 100%;
            cursor: pointer;
            transform: rotate(45deg) translateY(-50%);
        }

        .gallery-lightboxes .image-lightbox .image-lightbox-wrapper img {
            margin: 0 auto;
            max-height: 70vh;
        }

        /* Image privew */
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

        .file-upload,
        .file-upload-healthcard {
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

        .file-upload+.file-upload,
        .file-upload-healthcard+.file-upload-healthcard {
            margin-left: 10px;
        }

        .file-upload,
        .file-upload-healthcard {
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

        span.address-delete {
            position: absolute;
            right: 16px;
            top: 8px;
            font-size: 22px;
            color: #f30909;
            cursor: pointer;
        }

        span.address-edit {
            position: absolute;
            right: 47px;
            top: 8px;
            font-size: 22px;
            color: #196e0c;
            cursor: pointer;
        }

        p.card-text span {
            width: 100%;
            display: flex;
        }

        span.label.label-info {
            color: #fff;
            background: #099bdd;
            border-radius: 4px;
            padding: 2px 4px;
        }
    </style>
@endpush
@section('pagescript')
    <script>
        $(document).ready(function() {
            $('.collapse.in').prev('.panel-heading').addClass('active');
            $('#accordion, #bs-collapse,#accordion2,#accordionHealthcard')
                .on('show.bs.collapse', function(a) {
                    $(a.target).prev('.panel-heading').addClass('active');
                })
                .on('hide.bs.collapse', function(a) {
                    $(a.target).prev('.panel-heading').removeClass('active');
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




        function add_more(wrapper, inner, number_of_image = 8) {
            // files-wrapper
            $("#overlay").fadeIn(300);
            var numItems = $('.' + inner).length;
            if (numItems >= number_of_image) {
                alert('You only add ' + number_of_image + ' Images');
                $("#overlay").fadeOut(300);
                return false;
            }
            console.log(numItems);
            var html = '';
            html += '<div class="file-upload ' + inner + ' ' + numItems + '">';
            html += '<div class="file-select file-select-box">';
            html += '<div class="imagePreview"></div>';
            html += '<button class="file-upload-custom-btn" type="button"><i class="fa fa-plus"></i></button>';
            html += '<input type="file" name="files[]" class="profileimg" required>';
            html += '</div>';
            html += '<button class="file-close-custom-btn" type="button"><i class="fa fa-close"></i></button>';
            html += '</div>';
            $("." + wrapper).append(html);
            $("#overlay").fadeOut(300);

        }


        function delete_file() {

            $(this).closest('.file-upload').remove();
        }

        $(document).on("click", ".file-close-custom-btn", function(e) {
            e.preventdefault;
            $(this).closest('.file-upload').remove();
        });

        function delete_address(id) {

            console.log(id);
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure to delete this Address',
                buttons: {
                    confirm: function() {
                        $("#overlay").fadeIn(300);
                        var ajaxurl = '{{ route('admin.auth.user.create.address.remove', ':id') }}';
                        ajaxurl = ajaxurl.replace(':id', id);
                        $.ajax({
                            url: ajaxurl,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {

                                console.log('done');
                            }
                        }).done(function() {
                            setTimeout(function() {
                                $('.card-wrapper-' + id).remove();
                                $("#overlay").fadeOut(300);
                            }, 500);
                        });

                    },
                    cancel: function() {

                    }
                }
            });

        }

         function delete_pmethod(id) {

            console.log(id);
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure to delete this Payment Method',
                buttons: {
                    confirm: function() {
                        $("#overlay").fadeIn(300);
                        var ajaxurl = '{{ route('admin.auth.user.paymentmethod.remove', ':id') }}';
                        ajaxurl = ajaxurl.replace(':id', id);
                        $.ajax({
                            url: ajaxurl,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {

                                console.log('done');
                            }
                        }).done(function() {
                            setTimeout(function() {
                                $('.card-wrapper-pmethod-' + id).remove();
                                $("#overlay").fadeOut(300);
                            }, 500);
                        });

                    },
                    cancel: function() {

                    }
                }
            });

        }
    </script>
@endsection
