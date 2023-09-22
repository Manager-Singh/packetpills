@extends('backend.layouts.app')

@section('title', __('labels.backend.access.email-templates.management') . ' | ' . __('labels.backend.access.email-templates.create'))

@section('breadcrumb-links')
    @include('backend.provinces.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.provinces.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.provinces.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.provinces.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection