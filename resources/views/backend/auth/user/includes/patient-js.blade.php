@section('pagescript')
    <script>
        $(document).ready(function() {
            $('.collapse.in').prev('.panel-heading').addClass('active');
            $('#accordion, #bs-collapse,#accordion2,#accordionHealthcard,.myaccordion,.order-myaccordion,#accordionprimaryInsurance,#accordionsecondaryInsurance,#accordionternaryInsurance,#accordionquandaryInsurance,#accordionHealthinformation,#accordionPaymentmethod')
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
                content: 'Do you want to proceed with this?',
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
                content: 'Do you want to proceed with this?',
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
                content: 'Do you want to proceed with this?',
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

            $('.orderStatus').change(function() {
                var order_id = this.id;
                order_id = order_id.split('-');
                var norder_id = order_id[1];
                var order_status = $(this).val();
                var order_status_text = $(this).find("option:selected").text();
                console.log($(this).val());
                console.log(norder_id); 
                $.confirm({
                title: 'Confirm!',
                content: 'Do you want to proceed with this?',
                theme: 'material', // 'material', 'bootstrap'
                buttons: {
                    confirm: function() {



                        var ajaxurl = "{{ route('admin.auth.user.order.update.status') }}";
                        $("#overlay").fadeIn(300);
                        $.ajax({
                            url: ajaxurl,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: norder_id,
                                status: order_status,
                                type:"order"
                            },
                            dataType: 'JSON',
                            success: function(data) {
                                if (data != 0) {
                                    if (order_status == 'pending'){
                                        msg = '<span class="badge badge-warning"  style="right: 29px; position: absolute;">'+order_status_text+'</span>';
                                    }else if(order_status == 'cancelled'){
                                        msg = '<span class="badge badge-danger" style="right: 29px; position: absolute;">'+order_status_text+'</span>';
                                    }else if(order_status == 'approved'){
                                        msg = '<span class="badge badge-success" style="right: 29px; position: absolute;">'+order_status_text+'</span>';
                                    }else if(order_status == 'We need to contact doctor'){
                                        msg = '<span class="badge badge-success" style="right: 29px; position: absolute;">'+order_status_text+'</span>';
                                    }else if(order_status == 'processing'){
                                        msg = '<span class="badge badge-success" style="right: 29px; position: absolute;">'+order_status_text+'</span>';
                                    }else if(order_status == 'declined'){
                                        msg = '<span class="badge badge-danger" style="right: 29px; position: absolute;">'+order_status_text+'</span>';
                                    }else if(order_status == 'ready_to_pick'){
                                        msg = '<span class="badge badge-warning" style="right: 29px; position: absolute;">'+order_status_text+'</span>';
                                    }else if(order_status == 'picked_up'){
                                        msg = '<span class="badge badge-warning" style="right: 29px; position: absolute;">'+order_status_text+'</span>';
                                    }else if(order_status == 'in_transit'){
                                        msg = '<span class="badge badge-warning" style="right: 29px; position: absolute;">'+order_status_text+'</span>';
                                    }else if(order_status == 'delivered'){
                                        msg = '<span class="badge badge-success" style="right: 29px; position: absolute;">'+order_status_text+'</span>';
                                    }

                                    //declined
                                    $('.status-wrapper-'+data).html(msg);


                                   $("#overlay").fadeOut(300);
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

            });

            $('.existingRefillStatus').change(function() {
                var existingRefill_id = this.id;
                existingRefill_id = existingRefill_id.split('-');
                var nexistingRefill_id = existingRefill_id[1];
                var status = $(this).val();
                var status_text = $(this).find("option:selected").text();
                console.log($(this).val());
                console.log(nexistingRefill_id); 
                $.confirm({
                title: 'Confirm!',
                content: 'Do you want to proceed with this?',
                theme: 'material', // 'material', 'bootstrap'
                buttons: {
                    confirm: function() {



                        var ajaxurl = "{{ route('admin.auth.user.existing.refill.update.status') }}";
                        $("#overlay").fadeIn(300);
                        $.ajax({
                            url: ajaxurl,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: nexistingRefill_id,
                                status: status_text,
                                type:"order"
                            },
                            dataType: 'JSON',
                            success: function(data) {
                                if (data != 0) {
                                    if (status_text == 'pending'){
                                        msg = '<span class="badge badge-warning"  style="right: 29px; position: absolute;">'+order_status_text+'</span>';
                                    }else if(status_text == 'cancelled'){
                                        msg = '<span class="badge badge-danger" style="right: 29px; position: absolute;">'+status_text+'</span>';
                                    }else if(status_text == 'approved'){
                                        msg = '<span class="badge badge-success" style="right: 29px; position: absolute;">'+status_text+'</span>';
                                    }else if(status_text == 'We need to contact doctor'){
                                        msg = '<span class="badge badge-success" style="right: 29px; position: absolute;">'+status_text+'</span>';
                                    }else if(status_text == 'processing'){
                                        msg = '<span class="badge badge-success" style="right: 29px; position: absolute;">'+status_text+'</span>';
                                    }else if(status_text == 'declined'){
                                        msg = '<span class="badge badge-danger" style="right: 29px; position: absolute;">'+status_text+'</span>';
                                    }else if(status_text == 'ready_to_pick'){
                                        msg = '<span class="badge badge-warning" style="right: 29px; position: absolute;">'+status_text+'</span>';
                                    }else if(status_text == 'picked_up'){
                                        msg = '<span class="badge badge-warning" style="right: 29px; position: absolute;">'+status_text+'</span>';
                                    }else if(status_text == 'In Progress'){
                                        msg = '<span class="badge badge-warning" style="right: 29px; position: absolute;">'+status_text+'</span>';
                                    }else if(status_text == 'delivered'){
                                        msg = '<span class="badge badge-success" style="right: 29px; position: absolute;">'+status_text+'</span>';
                                    }
                                    
                                    window.location.reload();
                                    //declined
                                    $('.status-wrapper-'+data).html(msg);


                                $("#overlay").fadeOut(300);
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

            });

            $('.paymentStatus').change(function() {
                var payment_id = this.id;
                payment_id = payment_id.split('-');
                var npayment_id = payment_id[1];
                var payment_status = $(this).val();
                var payment_status_text = $(this).find("option:selected").text();
                console.log($(this).val());
                console.log(npayment_id); 
                $.confirm({
                title: 'Confirm!',
                content: 'Do you want to proceed with this?',
                theme: 'material', // 'material', 'bootstrap'
                buttons: {
                    confirm: function() {



                        var ajaxurl = "{{ route('admin.auth.user.order.update.status') }}";
                        $("#overlay").fadeIn(300);
                        $.ajax({
                            url: ajaxurl,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: npayment_id,
                                status: payment_status,
                                type:"payment"
                            },
                            dataType: 'JSON',
                            success: function(data) {
                                if (data != 0) {
                                   $("#overlay").fadeOut(300);
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

            });



            $('.transferStatus').change(function() {
                var transfer_id = this.id;
                transfer_id = transfer_id.split('-');
                var ntransfer_id = transfer_id[1];
                var transfer_status = $(this).val();
                var transfer_status_text = $(this).find("option:selected").text();
                console.log($(this).val());
                console.log(ntransfer_id); 
                $.confirm({
                title: 'Confirm!',
                content: 'Do you want to proceed with this?',
                theme: 'material', // 'material', 'bootstrap'
                buttons: {
                    confirm: function() {



                        var ajaxurl = "{{ route('admin.auth.user.transfer.update.status') }}";
                        $("#overlay").fadeIn(300);
                        $.ajax({
                            url: ajaxurl,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: ntransfer_id,
                                status: transfer_status
                            },
                            dataType: 'JSON',
                            success: function(data) {
                                if (data != 0) {
                                   

                                   if (transfer_status == 'pending'){
                                        var msg = '<span class="badge badge-warning"  style="right: 29px; position: absolute;">'+transfer_status_text+'</span>';
                                    }else if(transfer_status == 'cancelled'){
                                        var msg = '<span class="badge badge-danger" style="right: 29px; position: absolute;">'+transfer_status_text+'</span>';
                                    }else if(transfer_status == 'approved'){
                                        var msg = '<span class="badge badge-success" style="right: 29px; position: absolute;">'+transfer_status_text+'</span>';
                                    }else if(transfer_status == 'We need to contact doctor'){
                                        var msg = '<span class="badge badge-success" style="right: 29px; position: absolute;">'+transfer_status_text+'</span>';
                                    }else if(transfer_status == 'processing'){
                                        var msg = '<span class="badge badge-success" style="right: 29px; position: absolute;">'+transfer_status_text+'</span>';
                                    }else if(transfer_status == 'declined'){
                                        var msg = '<span class="badge badge-danger" style="right: 29px; position: absolute;">'+transfer_status_text+'</span>';
                                    }

                                    //declined
                                    $('.status-wrapper-'+ntransfer_id).html(msg);
                                    $("#overlay").fadeOut(300);
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

            });

            $('.prescripitonRefillStatus').change(function() {
                var prescription_id = this.id;
                prescription_id = prescription_id.split('-');
                var nprescription_id = prescription_id[1];
                var refill_status = $(this).val();
                var refill_status_text = $(this).find("option:selected").text();
                console.log($(this).val());
                console.log(nprescription_id); 
                $.confirm({
                title: 'Confirm!',
                content: 'Do you want to proceed with this?',
                theme: 'material', // 'material', 'bootstrap'
                buttons: {
                    confirm: function() {



                        var ajaxurl = "{{ route('admin.auth.user.prescription.refill.status') }}";
                        $("#overlay").fadeIn(300);
                        $.ajax({
                            url: ajaxurl,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: nprescription_id,
                                status: refill_status
                            },
                            dataType: 'JSON',
                            success: function(data) {
                                if (data != 0) {
                                    if (refill_status == 'pending'){
                                        var msg = '<span class="badge badge-warning"  style="right: 29px; position: absolute;">'+refill_status_text+'</span>';
                                    }else if(refill_status == 'cancelled'){
                                        var msg = '<span class="badge badge-danger" style="right: 29px; position: absolute;">'+refill_status_text+'</span>';
                                    }else if(refill_status == 'approved'){
                                        var msg = '<span class="badge badge-success" style="right: 29px; position: absolute;">'+refill_status_text+'</span>';
                                    }else if(refill_status == 'We need to contact doctor'){
                                        var msg = '<span class="badge badge-success" style="right: 29px; position: absolute;">'+refill_status_text+'</span>';
                                    }else if(refill_status == 'processing'){
                                        var msg = '<span class="badge badge-success" style="right: 29px; position: absolute;">'+refill_status_text+'</span>';
                                    }else if(refill_status == 'declined'){
                                        var msg = '<span class="badge badge-danger" style="right: 29px; position: absolute;">'+refill_status_text+'</span>';
                                    }

                                    //declined
                                    $('.status-wrapper-'+nprescription_id).html(msg);
                                   $("#overlay").fadeOut(300);
                                } else {
                                    console.log('Problem with save data');
                                }
                               // location.reload();
                            //  window.location.href = window.location.href+"#prescription-refill";
                                $("#overlay").fadeOut(300);
                            }
                        });

                    },
                    cancel: function() {

                    }
                }
            });

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
                '<input type="text" class="form-control" name="price[]" value="" placeholder="Drug Price" required min="1"' +
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

        $(document).ready(function(){   
    console.log('Using t'); 
      // make billing same as address
      $(document).on('click','input[name=same]',function() {
      console.log('Using the same address');  
      if ($("input[name=same]:checked").is(':checked')) { 
            $('#billing_address1').val($('#address1').val());
            $('#billing_address2').val($('#address2').val());
            $('#billing_postal_code').val($('#postal_code').val());             
            $('#billing_city').val($('#city').val());             
            var province = $('select[name=province] option:selected').val(); 
            $('select[name=billing_province]').val(province);
      }else{
          
            $('#billing_address1').val('');
            $('#billing_address2').val('');
            $('#billing_zip').val('');             
            $('#billing_city').val('');             
            var province = ''; 
            $('select[name=billing_province]').val(province);
        
        }              
    });


});

    
    function medicationDeleted(id) {
        var memdication_id = id;
        console.log(memdication_id); 
        $.confirm({
            title: 'Confirm!',
            content: 'Do you want to proceed with this?',
            theme: 'material', // 'material', 'bootstrap'
            buttons: {
                confirm: function() {
                    
                    var ajaxurl = "{{ route('admin.auth.user.prescription.refill.deleted') }}";
                    $("#overlay").fadeIn(300);
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: memdication_id,
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            if (data != 0) {
                                $("#medi-"+memdication_id).fadeOut(300);
                                $("#overlay").fadeOut(300);
                            } else {
                                console.log('Problem with save data');
                            }
                            // location.reload();
                        //  window.location.href = window.location.href+"#prescription-refill";
                            $("#medi-"+memdication_id).fadeOut(300);
                            $("#overlay").fadeOut(300);
                        }
                    });

                },
                cancel: function() {

                }
            }
        });

    }
    </script>
@endsection
