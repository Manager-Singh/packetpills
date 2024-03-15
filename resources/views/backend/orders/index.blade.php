@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Order Management'))

@section('breadcrumb-links')
@include('backend.orders.includes.breadcrumb-links')
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
                    {{ __('Order Management') }} <small class="text-muted">{{ __('Order List') }}</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="orders-table" class="table" data-ajax_url="{{ route("admin.orders.get") }}{{$status}}">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Amount</th>
                                <th>Order Status</th>
                                <th>Payment Status</th>
                                <th>Created at</th>
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
        FTX.Allorder.list.init();
    });
</script>
@stop