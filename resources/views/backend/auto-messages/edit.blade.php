@extends('backend.layouts.app')

@section('title', __('labels.backend.access.email-templates.management') . ' | ' . __('labels.backend.access.email-templates.edit'))

@section('breadcrumb-links')
    @include('backend.preciption-types.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::model($preciptionType, ['route' => ['admin.preciption-types.update', $preciptionType], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.preciption-types.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.preciption-types.index', 'id' => $preciptionType->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection