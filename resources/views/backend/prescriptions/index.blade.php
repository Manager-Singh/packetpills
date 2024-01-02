@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.prescriptions.management'))

@section('breadcrumb-links')
@include('backend.prescriptions.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.prescriptions.management') }} <small class="text-muted">{{ __('labels.backend.access.prescriptions.active') }}</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="prescriptions-table" class="table" data-ajax_url="{{ route("admin.prescriptions.get") }}">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.access.prescriptions.table.prescription_id') }}</th>
                                <th>Prescription Number</th>
                                <th>{{ trans('labels.backend.access.prescriptions.table.createdat') }}</th>
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
        FTX.Prescription.list.init();
    });
</script>
@stop