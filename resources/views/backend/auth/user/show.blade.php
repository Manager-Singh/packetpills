@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.view'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection


@section('content')
    @php
        if (session()->has('tab')) {
            $tab = session()->get('tab');
        } else {
            $tab = 'overview';
        }
    @endphp
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.users.management')
                        <small class="text-muted">@lang('labels.backend.access.users.view')</small>
                    </h4>
                </div><!--col-->
                <div class="col-sm-7">
                    @include('backend.auth.user.includes.send-message')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $tab == 'overview' ? 'active' : '' }}" data-toggle="tab" href="#overview"
                                role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i>
                                @lang('labels.backend.access.users.tabs.titles.overview')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ $tab == 'address' ? 'active' : '' }}" data-toggle="tab" href="#address"
                                role="tab" aria-controls="address" aria-expanded="true"><i
                                    class="fas fa-address-card"></i> @lang('labels.backend.access.users.tabs.titles.address')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ $tab == 'healthcard' ? 'active' : '' }}" data-toggle="tab"
                                href="#healthcard" role="tab" aria-controls="healthcard" aria-expanded="true"><i
                                    class="fas fa-heart"></i> @lang('labels.backend.access.users.tabs.titles.healthcard')</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link {{ $tab == 'insurance' ? 'active' : '' }}" data-toggle="tab"
                                href="#insurance" role="tab" aria-controls="insurance" aria-expanded="true"><i
                                    class="fas fa-mortar-board"></i> @lang('labels.backend.access.users.tabs.titles.insurance')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $tab == 'healthinformation' ? 'active' : '' }}" data-toggle="tab"
                                href="#healthinformation" role="tab" aria-controls="healthinformation"
                                aria-expanded="true"><i class="fas fa-info-circle"></i> @lang('Health Information')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $tab == 'paymentmethod' ? 'active' : '' }}" data-toggle="tab"
                                href="#paymentmethod" role="tab" aria-controls="paymentmethod" aria-expanded="true"><i
                                    class="fas fa-credit-card"></i> @lang('Payment Method')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $tab == 'medications' ? 'active' : '' }}" data-toggle="tab"
                                href="#medications" role="tab" aria-controls="medications" aria-expanded="true"><i
                                    class="fas fa fa-ambulance"></i> @lang('Medications')</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link {{ $tab == 'orders' ? 'active' : '' }}" data-toggle="tab"
                                href="#orders" role="tab" aria-controls="orders" aria-expanded="true"><i
                                    class="fas fa-shopping-cart"></i> @lang('Orders')</a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane {{ $tab == 'overview' ? 'active' : '' }}" id="overview" role="tabpanel"
                            aria-expanded="true">
                            @include('backend.auth.user.show.tabs.overview')
                        </div><!--tab-->

                        <div class="tab-pane {{ $tab == 'address' ? 'active' : '' }}" id="address" role="tabpanel"
                            aria-expanded="true">
                            @include('backend.auth.user.show.tabs.address')
                        </div><!--tab-->

                        <div class="tab-pane {{ $tab == 'healthcard' ? 'active' : '' }}" id="healthcard" role="tabpanel"
                            aria-expanded="true">
                            @include('backend.auth.user.show.tabs.healthcard')
                        </div><!--tab-->

                        <div class="tab-pane {{ $tab == 'insurance' ? 'active' : '' }}" id="insurance" role="tabpanel"
                            aria-expanded="true">
                            @include('backend.auth.user.show.tabs.insurance')
                        </div><!--tab-->

                        <div class="tab-pane {{ $tab == 'healthinformation' ? 'active' : '' }}" id="healthinformation"
                            role="tabpanel" aria-expanded="true">
                            @include('backend.auth.user.show.tabs.healthinformation')
                        </div><!--tab-->
                        <div class="tab-pane {{ $tab == 'paymentmethod' ? 'active' : '' }}" id="paymentmethod"
                            role="tabpanel" aria-expanded="true">
                            @include('backend.auth.user.show.tabs.paymentmethod')
                        </div><!--tab-->
                        <div class="tab-pane {{ $tab == 'medications' ? 'active' : '' }}" id="medications"
                            role="tabpanel" aria-expanded="true">
                            @include('backend.auth.user.show.tabs.medications')
                        </div><!--tab-->
                         <div class="tab-pane {{ $tab == 'orders' ? 'active' : '' }}" id="orders"
                            role="tabpanel" aria-expanded="true">
                            @include('backend.auth.user.show.tabs.orders')
                        </div><!--tab-->


                    </div><!--tab-content-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <small class="float-right text-muted">
                        <strong>@lang('labels.backend.access.users.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($user->created_at) }}
                        ({{ $user->created_at->diffForHumans() }}),
                        <strong>@lang('labels.backend.access.users.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($user->updated_at) }}
                        ({{ $user->updated_at->diffForHumans() }})
                        @if ($user->trashed())
                            <strong>@lang('labels.backend.access.users.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($user->deleted_at) }}
                            ({{ $user->deleted_at->diffForHumans() }})
                        @endif
                    </small>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    
@endsection
