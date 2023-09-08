@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.enterpriseconnects.management'))

@section('breadcrumb-links')
@include('backend.enterprise-connects.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.enterpriseconnects.management') }} <small class="text-muted">{{ __('labels.backend.access.enterpriseconnects.active') }}</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="enterprise-connect-table" class="table" data-ajax_url="{{ route('admin.enterprise.connect.get') }}">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.access.enterpriseconnects.table.fullname') }}</th>
                                <th>{{ trans('labels.backend.access.enterpriseconnects.table.company') }}</th>
                                <th>{{ trans('labels.backend.access.enterpriseconnects.table.job_title') }}</th>
                                <th>{{ trans('labels.backend.access.enterpriseconnects.table.email') }}</th>
                                <th>{{ trans('labels.backend.access.enterpriseconnects.table.phone_no') }}</th>
                                <th>{{ trans('labels.backend.access.enterpriseconnects.table.status') }}</th>
                                <th>{{ trans('labels.backend.access.enterpriseconnects.table.createdat') }}</th>
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
        FTX.EnterpriseConnect.list.init();
    });
</script>
@stop