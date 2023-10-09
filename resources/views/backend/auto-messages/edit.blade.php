@extends('backend.layouts.app')

@section('title', __('labels.backend.access.email-templates.management') . ' | ' . __('labels.backend.access.email-templates.edit'))

@section('breadcrumb-links')
    @include('backend.auto-messages.includes.breadcrumb-links')
@endsection

@section('content')

{{ Form::model($autoMessage, ['route' => ['admin.auto-messages.update', $autoMessage], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.auto-messages.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.auto-messages.index', 'id' => $autoMessage->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection