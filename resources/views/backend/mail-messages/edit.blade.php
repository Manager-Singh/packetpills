@extends('backend.layouts.app')

@section('title', __('labels.backend.access.email-templates.management') . ' | ' . __('labels.backend.access.email-templates.edit'))

@section('breadcrumb-links')
    @include('backend.mail-messages.includes.breadcrumb-links')
@endsection

@section('content')

{{ Form::model($MailMessage, ['route' => ['admin.mail-messages.update', $MailMessage], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.mail-messages.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.mail-messages.index', 'id' => $MailMessage->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection