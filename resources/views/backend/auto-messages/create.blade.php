@extends('backend.layouts.app')

@section('title', __('labels.backend.access.email-templates.management') . ' | ' . __('labels.backend.access.email-templates.create'))

@section('breadcrumb-links')
    @include('backend.auto-messages.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.auto-messages.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.auto-messages.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.auto-messages.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection