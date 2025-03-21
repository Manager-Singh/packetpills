@extends('backend.layouts.app')

@section('title', __('labels.backend.access.prescriptions.management') . ' | ' . __('labels.backend.access.prescriptions.create'))

@section('breadcrumb-links')
    @include('backend.referal.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('Referrals Management') }} <small class="text-muted">{{ __('Referrals List') }}</small>
                    <div class="exports-button">
                        <a href="{{ route('admin.referrals.export', 'new') }}" class="btn btn-success left" onclick="setTimeout(() => location.reload(), 2000);">Download New CSV</a>
                        <a href="{{ route('admin.referrals.export', 'all') }}" class="btn btn-warning left" onclick="setTimeout(() => location.reload(), 2000);">Download All New and Old CSV</a>
                    </div>
                    </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="referrals-table" class="table" data-ajax_url="{{ route("admin.referrals.get") }}">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Source</th>
                                <th>Details</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <!-- <th>{{ trans('labels.general.actions') }}</th> -->
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
        FTX.Referrals.list.init();
    });
</script>
@stop