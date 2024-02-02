@extends('backend.layouts.app')

@section('title', __('labels.backend.access.prescriptions.management') . ' | ' . __('labels.backend.access.prescriptions.create'))

@section('breadcrumb-links')
    @include('backend.setting.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.setting.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        
    <div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                {{ __('Email Signature') }}
                <small class="text-muted">{{ __('create') }}</small>
            </h4>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <hr>

    <div class="row mt-4 mb-4">
        <div class="col">
            <div class="form-group row" >
                <label for="title" class="col-md-2 from-control-label required">Title:</label>

                <div class="col-md-10">
                    <input class="form-control" placeholder="" value="{{(isset($setting->name)) ? $setting->name : old('name')}}" name="name" type="text" id="name">
                </div>
            </div>
            <div class="form-group row" >
                <label for="title" class="col-md-2 from-control-label required">Email:</label>

                <div class="col-md-10">
                    <input class="form-control" placeholder="" value="{{(isset($setting->email)) ? $setting->email : old('email')}}" name="email" type="email" id="email">
                </div>
            </div>
            <div class="form-group row" >
                <label for="desciption"  class="col-md-2 from-control-label required">Desciption:</label>

                <div class="col-md-10">
                    <textarea class="form-control"  id="desciption" placeholder="" name="desciption" type="text">{{ (isset($setting->desciption)) ? $setting->desciption : '' }}</textarea>
                </div>
            </div>
            <div class="form-group row" >
                <label for="call" class="col-md-2 from-control-label required">Call:</label>

                <div class="col-md-10">
                    <input class="form-control" id="call" value="{{(isset($setting->call)) ? $setting->call : old('call')}}" placeholder="" name="call" type="text">
                </div>
            </div>
            <div class="form-group row" >
                <label for="fax" class="col-md-2 from-control-label required">Fax:</label>

                <div class="col-md-10">
                    <input class="form-control" value="{{(isset($setting->fax)) ? $setting->fax : old('fax')}}" id="fax" placeholder="" name="fax" type="text">
                </div>
            </div>
            <div class="form-group row" >
                <label for="thanks_regards" class="col-md-2 from-control-label required">Thanks Regards :</label>

                <div class="col-md-10">
                    <textarea class="form-control" id="thanks_regards" placeholder="" name="thanks_regards" type="text">{{(isset($setting->thanks_regards)) ? $setting->thanks_regards : ''}}</textarea>
                </div>
            </div>
            <div class="form-group row" >
                <label for="address" class="col-md-2 from-control-label required">Address :</label>

                <div class="col-md-10">
                    <textarea class="form-control" id="address" placeholder="" name="address" type="text">{{(isset($setting->address)) ? $setting->address : ''}}</textarea>
                </div>
            </div>
            <div class="form-group row" >
                <label for="logo_path" class="col-md-2 from-control-label required">Upload Logo :</label>

                <div class="col-md-6">
                    <input class="form-control" id="logo_path" placeholder="" name="logo_path" type="file">
                </div>
                @if(isset($setting->logo_path))
                    <div class="col-md-4">
                        <img width="200" src="{{$setting->logo_path}}" />
                    </div>
                @endif
            </div>

           
            
            
        </div>
        <!--col-->
    </div>
    <!--row-->
</div>
<!--card-body-->











        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.prescriptions.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection