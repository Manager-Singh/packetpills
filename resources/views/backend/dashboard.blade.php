@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-primary">
                    <div class="card-body pb-0">
                        <div class="btn-group float-right">
                            <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('admin.auth.user.index') }}">View all</a>
                            </div>
                        </div>
                        <div class="text-value">{{$userDataset["count"]}}</div>
                        <div>Total Patient</div>
                    </div>
                    <div class="chart-wrapper mt-3 mx-3" style="height: 70px;">
                        <canvas id="card-chart1" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-info">
                    <div class="card-body pb-0">
                       
                        <button class="btn btn-transparent dropdown-toggle p-0 float-right" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-map-marker-alt"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('admin.prescriptions.index') }}">View all</a>
                            </div>
                        <div class="text-value">{{$prescriptionDataset["count"]}}</div>
                        <div>Total Prescription</div>
                    </div>
                    <div class="chart-wrapper mt-3 mx-3" style="height: 70px;">
                    
                    
                        <canvas id="card-chart2" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-warning">
                    <div class="card-body pb-0">
                        <div class="btn-group float-right">
                            <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('admin.orders.index') }}">Action</a>
                            </div>
                        </div>
                        <div class="text-value">{{$orderDataset['count']}}</div>
                        <div>Total Orders</div>
                    </div>
                    <div class="chart-wrapper mt-3" style="height: 70px;">
                        <canvas id="card-chart3" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-dark">
                    <div class="card-body pb-0">
                        <div class="btn-group float-right">
                            <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('admin.transfer-requests.index') }}">View all</a>
                            </div>
                        </div>
                        <div class="text-value">{{$transferRequestDataset["count"]}}</div>
                        <div>Total Transfer Requests</div>
                    </div>
                    <div class="chart-wrapper mt-3 mx-3" style="height: 70px;">
                        <canvas id="card-chart5" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!-- <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-danger">
                    <div class="card-body pb-0">
                        <div class="btn-group float-right">
                            
                        </div>
                        <div class="text-value">${{$orderRevenueDataset["count"]}}</div>
                        <div>Total Revenue</div>
                    </div>
                    <div class="chart-wrapper mt-3 mx-3" style="height: 70px;">
                        <canvas id="card-chart4" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div> -->
        </div>
          <div class="row">

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-info">
                    <div class="card-body pb-0">
                        <div class="btn-group float-right">
                            <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('admin.prescription.refill.index') }}">Action</a>
                            </div>
                        </div>
                        <div class="text-value">{{$prescriptionRefill['count']}}</div>
                        <div>Total Prescription Refill</div>
                    </div>
                    <div class="chart-wrapper mt-3" style="height: 70px;">
                        <canvas id="card-chart3" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-info">
                    <div class="card-body pb-0">
                        <div class="btn-group float-right">
                            <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('admin.prescription.existing.refill.index') }}">Action</a>
                            </div>
                        </div>
                        <div class="text-value">{{$existingPrescriptionRefill['count']}}</div>
                        <div>Total  Existing Prescription Refill</div>
                    </div>
                    <div class="chart-wrapper mt-3" style="height: 70px;">
                        <canvas id="card-chart3" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
          </div>
          </div>
     

 
@endsection

@section('pagescript')
 <script>
  "use strict";

/* eslint-disable object-shorthand */

/* global Chart, CustomTooltips, getStyle, hexToRgba */

/**
 * --------------------------------------------------------------------------
 * CoreUI Free Boostrap Admin Template (v2.1.15): main.js
 * Licensed under MIT (https://coreui.io/license)
 * --------------------------------------------------------------------------
 */

/* eslint-disable no-magic-numbers */
// Disable the on-canvas tooltip

//# sourceMappingURL=main.js.map
   </script>
@endsection