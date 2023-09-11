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
                                <th>{{ trans('labels.backend.access.drugs.table.brand_name') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.generic_name') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.main_therapeutic_use') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.strength') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.strength_unit') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.format') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.manufacturer') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.pack_size') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.pack_unit') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.din') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.presciption_required') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.upc') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.pharmacy_purchase_price') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.percent_markup') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.drug_cost') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.dispensing_fee') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.insurance_coverage_in_percent') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.insurance_coverage_calculation_in_percent') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.delivery_cost') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.patient_pays') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.drug_indication') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.standard_dosage') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.side_effect') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.contraindications') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.precautions') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.warnings') }}</th>
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