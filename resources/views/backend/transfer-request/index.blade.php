@extends('backend.layouts.app')

@section('title', app_name() . ' | Transfer Requests' )

@section('breadcrumb-links')
@include('backend.transfer-request.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    <!-- {{ __('labels.backend.access.prescriptions.management') }}  -->
                    Transfer Requests Management
                    
                    <small class="text-muted">
                        <!-- {{ __('labels.backend.access.prescriptions.active') }} -->
                        Active Transfer Requests
                    </small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="transfer-requests-table" class="table" data-ajax_url="{{ route('admin.transfer.request.get') }}">
                        <thead>
                            <tr>
                            <th>Patient Name</th>
                            <th>Patient DOB</th>
                            <th>Patient Phone No.</th>

                                <th>Pharmacy Name</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>{{ trans('labels.backend.access.prescriptions.table.createdat') }}</th>
                                <th>Status</th> 
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->

    </div>
    <!--card-body-->
</div>
<!--card-->
@endsection

@section('pagescript')
<script>
    FTX.Utils.documentReady(function() {
        console.log(FTX);
        FTX.TransferRequests.list.init();
    });

    
    function transferStatusChange(id){
        
                var transfer_id = id;
                console.log(this);
                _this = $('#transferStatus-'+id);
                transfer_id = transfer_id;
                var ntransfer_id = id;
                var transfer_status = $('#transferStatus-'+id).find("option:selected").val();
                var transfer_status_text = $('#transferStatus-'+id).find("option:selected").text();
                console.log(transfer_status);
                console.log(transfer_status_text); 
                $.confirm({
                title: 'Confirm!',
                content: 'Are you sure to ' + transfer_status_text + ' transfer request?',
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

        };
</script>
@stop