@extends('backend.layouts.app')

@section('title', __('labels.backend.access.prescriptions.management') . ' | ' . __('labels.backend.access.prescriptions.create'))

@section('breadcrumb-links')
    @include('backend.prescriptions.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.prescriptions.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.prescriptions.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.prescriptions.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection