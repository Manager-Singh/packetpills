@extends('backend.layouts.app')

@section('title', __('labels.backend.access.drugs.management') . ' | ' . __('labels.backend.access.drugs.edit'))

@section('breadcrumb-links')
    @include('backend.drugs.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($blog, ['route' => ['admin.drugs.update', $blog], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

    <div class="card">
        @include('backend.drugs.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.drugs.index', 'id' => $blog->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection