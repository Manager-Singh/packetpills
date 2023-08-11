@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.drugs.management'))

@section('breadcrumb-links')
@include('backend.drugs.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.drugs.management') }} <small class="text-muted">{{ __('labels.backend.access.drugs.active') }}</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->
  
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="drugs-table" class="table" data-ajax_url="{{ route('admin.drugs.get') }}">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.access.drugs.table.name') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.available_form') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.strength') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.description') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.status') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.createdat') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
                            </tr>
                        </thead>

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
        console.log(FTX.Drugs.list);
        FTX.Drugs.list.init();
    });
</script>
@stop