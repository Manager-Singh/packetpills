@extends('backend.layouts.app')

@section('title', __('labels.backend.access.prescriptions.management') . ' | ' . __('labels.backend.access.prescriptions.show'))

@section('breadcrumb-links')
@include('backend.prescriptions.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.prescriptions.show') }} <small class="text-muted">{{ __('labels.backend.access.prescriptions.active') }}</small>
                </h4>
            </div>
            <!--col-->
        </div>

        <div class="row mt-4 mb-4">
            <div class="col">
                <ul class="nav nav-tabs" role="tablist">
                    
                    @if($prescription && $prescription->prescription_iteams && $prescription->prescription_iteams->count() > 0)
                        @foreach($prescription->prescription_iteams as $key=>$iteam)
                            <li class="nav-item">
                                <a class="nav-link {{ ($key == 0) ? 'active' : ''}} " data-toggle="tab" href="#page-no-{{$iteam->page_no}}" role="tab" aria-controls="page-no-{{$iteam->page_no}}" aria-expanded="true"><i class="fas fa-user"></i> @lang('labels.backend.access.prescriptions.tabs.titles.page') {{$iteam->page_no}}</a>
                            </li>
                        
                        @endforeach
                    @else
                    @endif
                    
                    
                </ul>

                <div class="tab-content">
                    
                    @if($prescription && $prescription->prescription_iteams && $prescription->prescription_iteams->count() > 0)
                        @foreach($prescription->prescription_iteams as $key=>$iteam)
                            <div class="tab-pane {{ ($key == 0) ? 'active' : ''}}" id="page-no-{{$iteam->page_no}}" role="tabpanel" aria-expanded="true">
                                @include('backend.prescriptions.tabs.overview',['iteam'=>$iteam, 'drugs'=>$drugs])
                            </div><!--tab-->
                        @endforeach
                    @else

                    @endif
                    
                    
                </div><!--tab-content-->
            </div><!--col-->


        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                   
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection