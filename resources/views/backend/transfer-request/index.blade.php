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
                                <th>Pharmacy Name</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>{{ trans('labels.backend.access.prescriptions.table.createdat') }}</th>
                             
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
        FTX.TransferRequests.list.init();
    });
</script>
@stop