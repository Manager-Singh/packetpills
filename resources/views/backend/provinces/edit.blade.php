@extends('backend.layouts.app')

@section('title', __('labels.backend.access.provinces.management') . ' | ' . __('labels.backend.access.provinces.edit'))

@section('breadcrumb-links')
    @include('backend.provinces.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::model($province, ['route' => ['admin.provinces.update', $province], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.provinces.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.provinces.index', 'id' => $province->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection