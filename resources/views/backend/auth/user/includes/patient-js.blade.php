@section('pagescript')
    <script>
        $(document).ready(function() {
            $('.collapse.in').prev('.panel-heading').addClass('active');
            $('#accordion, #bs-collapse,#accordion2,#accordionHealthcard,.myaccordion,#accordionprimaryInsurance,#accordionsecondaryInsurance,#accordionternaryInsurance,#accordionquandaryInsurance,#accordionHealthinformation,#accordionPaymentmethod')
                .on('show.bs.collapse', function(a) {
                    $(a.target).prev('.panel-heading').addClass('active');
                })
                .on('hide.bs.collapse', function(a) {
                    $(a.target).prev('.panel-heading').removeClass('active');
                });



            $(".drug-data").select2({
                width: '100%',
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




        function add_more(wrapper, inner, number_of_image = 8, a_id = 0) {
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
            if (a_id != 0) {
                html += '<input type="file" name="files_' + a_id + '[]" class="profileimg" required>';

            } else {
                html += '<input type="file" name="files[]" class="profileimg" required>';

            }
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
                        var ajaxurl = '{{ route('admin.auth.user.create.address.remove', ': id') }}';
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
                        var ajaxurl = '{{ route('admin.auth.user.paymentmethod.remove', ': id') }}';
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

        function change_status(id, status) {

            console.log(id);
            console.log(status);
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure to ' + status + ' Prescription?',
                theme: 'material', // 'material', 'bootstrap'
                buttons: {
                    confirm: function() {



                        var ajaxurl = "{{ route('admin.auth.user.prescription.update.status') }}";
                        $("#overlay").fadeIn(300);
                        $.ajax({
                            url: ajaxurl,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                prescription_id: id,
                                status: status
                            },
                            dataType: 'JSON',
                            success: function(data) {
                                if (data != 0) {
                                    if (status == 'Cancel') {

                                        message =
                                            '<span class="badge badge-danger status-wrapper-' + id +
                                            '" style="right: 29px; position: absolute;">Cancelled</span>';
                                        $(".approve-" + id).show();
                                        $(".cancel-" + id).hide();
                                        $(".medication-form-" + id).hide();

                                    }
                                    if (status == 'Approve') {
                                        message =
                                            '<span class="badge badge-success status-wrapper-' +
                                            id +
                                            '" style="right: 29px; position: absolute;">Approved</span>';
                                        $(".approve-" + id).hide();
                                        $(".cancel-" + id).show();
                                        $(".medication-form-" + id).show();
                                    }
                                    $(".status-wrapper-" + id).html(message);
                                } else {
                                    console.log('Problem with save data');
                                }
                                $("#overlay").fadeOut(300);
                            }
                        });

                    },
                    cancel: function() {

                    }
                }
            });

        }
        $(document).ready(function() {
            $('input[type=radio][name=allergies]').change(function() {
                if ($(this).is(':checked')) {
                    if (this.value == 1) {
                        $('.allergies-medications').show();
                    } else {
                        $('.allergies-medications').hide();
                    }

                }
            });

        });
        var room = 1;

        function education_fields(id) {

            room++;
            var objTo = document.getElementById("education_fields-" + id);
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group removeclass" + room);
            var rdiv = "removeclass" + room;
            divtest.innerHTML =
                '<div class="row main-idv">' +
                '<div class="col-sm-3 nopadding">' +
                '<div class="form-group">' +
                '<input type="text" class="form-control" name="drug[]" value="" placeholder="Drug Name" required>' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-3 nopadding">' +
                '<div class="form-group">' +
                '<div class="input-group">' +
                '<input type="number" class="form-control" name="price[]" value="" placeholder="Drug Price" required min="1" pattern="[0-9]" onkeypress="return !(event.charCode == 46)" step="1">' +
                 '<div class="input-group-btn">' +
                '<button class="btn btn-danger" type="button" onclick="remove_education_fields(' + room + ');">' +
                '<span class="fa fa-minus" aria-hidden="true"></span>' +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                
                '<div class="clear"></div>' +
                '</div>';

            objTo.appendChild(divtest);
            $(".drug-data").select2({
                width: '100%',
            });

        }

        function remove_education_fields(rid) {
            $(".removeclass" + rid).remove();
        }
    </script>
@endsection
