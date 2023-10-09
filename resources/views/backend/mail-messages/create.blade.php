@extends('backend.layouts.app')

@section('title', __('labels.backend.access.email-templates.management') . ' | ' . __('labels.backend.access.email-templates.create'))

@section('breadcrumb-links')
    @include('backend.mail-messages.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.mail-messages.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.mail-messages.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.mail-messages.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection