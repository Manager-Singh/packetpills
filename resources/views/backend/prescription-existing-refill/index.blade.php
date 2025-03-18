@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.prescriptions.management'))

@section('breadcrumb-links')
@include('backend.prescription-existing-refill.includes.breadcrumb-links')
@endsection
@php 
if(isset($_GET['status'])){
    $status = '?status='.$_GET['status'];
}else{
    $status = '';
}
@endphp
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('Existing Refill Management') }} <small class="text-muted">{{ __('labels.backend.access.prescriptions.active') }}</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="prescriptions-existing-table" class="table" data-ajax_url="{{ route("admin.prescription.existing.refill.get") }}{{$status}}">
                        <thead>
                            <tr>
                                <th>Prescription Number</th>
                                <th>Patient Name</th>
                                <th>Medication</th>
                                <th>{{ trans('labels.backend.access.prescriptions.table.createdat') }}</th>
                                <th>Status</th>
                                <th>{{ trans('labels.general.actions') }}</th>
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
        FTX.Prescriptionexisting.list.init();
    });
</script>
@stop