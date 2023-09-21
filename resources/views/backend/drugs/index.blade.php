@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.drugs.management'))

@section('breadcrumb-links')
@include('backend.drugs.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
    <div class="row">
        <div class="col-md-12" style="text-align:end;">
                <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#upload-drug-csv">Upload Drugs CSV</button>
        </div>
    </div>
<!-- Modal -->
    <div class="modal fade" id="upload-drug-csv" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form action="{{route('admin.drugs.upload.csv')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Header</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        
                    </div>
                    <div class="modal-body">
                        Select Drug CSV to upload:
                        <input type="file" name="drug_csv" id="fileToUpload" accept=".csv" required>
                        <br>
                        <a href="{{asset('img/backend/drugs/drugs.csv')}}" class="download-sample">Download Sample</a>
                    </div>
                    <div class="modal-footer">
                    <input type="submit" value="Upload CSV" class="btn btn-success" name="submit">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Modal close -->
       
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
                                <th>Image</th>
                                <th>{{ trans('labels.backend.access.drugs.table.brand_name') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.generic_name') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.main_therapeutic_use') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.strength') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.format') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.manufacturer') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.pack_size') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.pharmacy_purchase_price') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.drug_cost') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.dispensing_fee') }}</th>
                                <th>{{ trans('labels.backend.access.drugs.table.patient_pays') }}</th>
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
<style>
    img.listing-image {
    box-shadow: 0px 0px 5px 0px #000;
    border-radius: 14px;
}
    </style>
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