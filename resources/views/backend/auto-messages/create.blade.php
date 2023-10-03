@extends('backend.layouts.app')

@section('title', __('labels.backend.access.email-templates.management') . ' | ' . __('labels.backend.access.email-templates.create'))

@section('breadcrumb-links')
    @include('backend.preciption-types.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.preciption-types.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.preciption-types.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.preciption-types.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection