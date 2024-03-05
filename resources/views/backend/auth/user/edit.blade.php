@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit'))

@section('breadcrumb-links')
@include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')

{{ Form::model($user, ['route' => ['admin.auth.user.update', $user], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH','files' => true]) }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.users.management')
                    <small class="text-muted">@lang('labels.backend.access.users.edit')</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <hr>

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    {{ Form::label('first_name', __('validation.attributes.backend.access.users.first_name'), [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.first_name'), 'required' => 'required']) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label('last_name', __('validation.attributes.backend.access.users.last_name'), [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.last_name'), 'required' => 'required']) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                  <!--image avtaar-->
                    <div class="form-group row">
                      
                        <label class="col-md-2" for="avatar">Avatar</label>

                        <div class="col-md-10" id="avatar_location">
                            <input class="form-control-file" type="file" name="avatar_location" id="avatar_location">
                        </div><!--form-group-->
                        
                    </div>
                    <!--image avtaar end-->

                <div class="form-group row">
                    {{ Form::label('email', __('validation.attributes.backend.access.users.email'), [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.email'), 'required' => 'required']) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('mobile_no', __('validation.attributes.backend.access.users.mobile_no'), [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('mobile_no', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.mobile_no'), 'required' => 'required']) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('gender', trans('validation.attributes.backend.access.users.gender'), ['class' => 'col-md-2 control-label']) }}
                    <div class="col-md-8">
                        <label for="gender-male" class="control">
                            <input type="radio" value="male" name="gender" id="gender-male" class="gender" {{ $user->gender == 'male' ? 'checked' : ''}} /> &nbsp;&nbsp;@lang('validation.attributes.backend.access.users.male')
                        </label>
                        <label for="gender-female" class="control">
                            <input type="radio" value="female" name="gender" id="gender-female" class="gender" {{ $user->gender == 'female' ? 'checked' : ''}} /> &nbsp;&nbsp;@lang('validation.attributes.backend.access.users.female')
                        </label>
                        <label for="gender-other" class="control">
                            <input type="radio" value="Prefer To Not Share" name="gender" id="gender-other" class="gender" {{ $user->gender == 'Prefer To Not Share' ? 'checked' : ''}} /> &nbsp;&nbsp;@lang('Prefer To Not Share')
                        </label>
                    </div>
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ Form::label('date_of_birth', __('validation.attributes.backend.access.users.d_o_b'), [ 'class'=>'col-md-2 form-control-label']) }}

                        <div class="col-md-10">
                        <div class="input-group date">
                            <input class="form-control" id="datepicker" name="date_of_birth" data-date-format="YYYY-MM-DD" value="{{ $user->date_of_birth}}" type="text" readonly />
                           </div>
                        </div>
                    <!--col-->
                </div>

                <div class="form-group row">
                    {{ Form::label('province', trans('validation.attributes.backend.access.users.province'), ['class' => 'col-md-2 from-control-label required']) }}

                    <div class="col-md-10">
                        {{ Form::select('province', $provinces, $user->province, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.users.province')]) }}
                    </div>
                    <!--col-->
                </div>

                @if ($user->id != 1)

                <div class="form-group row">
                    {{ Form::label('status', trans('validation.attributes.backend.access.users.active'), ['class' => 'col-md-2 control-label']) }}
                    <div class="col-md-10">
                        {{ Form::checkbox('status', '1', $user->status == 1) }}
                    </div>
                </div>
                <!--form control-->

                <div class="form-group row">
                    {{ Form::label('confirmed', trans('validation.attributes.backend.access.users.confirmed'), ['class' => 'col-md-2 control-label']) }}
                    <div class="col-md-10">
                        {{ Form::checkbox('confirmed', '1', $user->confirmed == 1) }}
                    </div>
                </div>
                <!--form control-->

                <div class="form-group row">
                    {{ Form::label('status', trans('validation.attributes.backend.access.users.associated_roles'), ['class' => 'col-md-2 control-label']) }}

                    <div class="col-md-8">
                        @if (count($roles) > 0)
                        @foreach($roles as $role)
                        @if ($logged_in_user->roles[0]->name == "Administrator" || $role->name == "User")
                        <label for="role-{{$role->id}}" class="control">
                            <input type="radio" value="{{$role->id}}" name="assignees_roles[]" {{ is_array(old('assignees_roles')) ? (in_array($role->id, old('assignees_roles')) ? 'checked' : '') : (in_array($role->id, $userRoles) ? 'checked' : '') }} id="role-{{$role->id}}" class="get-role-for-permissions" /> &nbsp;&nbsp;{!! $role->name !!}
                        </label>
                        @endif
                        <!--permission list-->
                        @endforeach
                        @else
                        {{ trans('labels.backend.access.users.no_roles') }}
                        @endif
                    </div>
                    <!--col-lg-3-->
                </div>
                <!--form control-->

                <div class="form-group row">
                    {{ Form::label('associated-permissions', trans('validation.attributes.backend.access.roles.associated_permissions'), ['class' => 'col-md-2 control-label']) }}
                    <div class="col-md-10 search-permission">
                        <div id="available-permissions">
                            <div>
                                <input type="text" class="form-control search-button" placeholder="Search..." />
                            </div>
                            <div class="get-available-permissions">
                                @if ($permissions)
                                @foreach ($permissions as $id => $display_name)
                                <div>
                                    <input type="checkbox" name="permissions[{{ $id }}]" value="{{ $id }}" id="perm_{{ $id }}" {{ isset($userPermissions) && in_array($id, $userPermissions) ? 'checked' : '' }} /> <label for="perm_{{ $id }}" style="margin-left:20px;">{{ $display_name }}</label>
                                </div>
                                @endforeach
                                @else
                                <p>There are no available permissions.</p>
                                @endif
                            </div>
                            <!--col-lg-6-->

                        </div>
                        <!--available permissions-->
                    </div>
                    <!--col-lg-3-->
                </div>
                <!--form control-->
                @endif
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-body-->

    @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.auth.user.index', 'id' => $user->id ])
</div>
<!--card-->
@if ($user->id == 1)
{{ Form::hidden('status', 1) }}
{{ Form::hidden('confirmed', 1) }}
{{ Form::hidden('assignees_roles[]', 1) }}
@endif

{{ Form::close() }}
@endsection

@section('pagescript')
<script>
    FTX.Utils.documentReady(function() {
        FTX.Users.edit.selectors.getPremissionURL = "{{ route('admin.get.permission') }}";
        FTX.Users.edit.init();
    });
    $(function () {
        $("#datepicker").datepicker({ 
                autoclose: true, 
                todayHighlight: true,
                format: "yyyy-mm-dd",
        });
    });
</script>
@endsection