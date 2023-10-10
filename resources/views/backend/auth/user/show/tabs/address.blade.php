<div class="col">

    <h4 class="text-center">Address Details </h4>
    @if (count($user->address) < 2)
        <div class="panel-group wrap" id="accordionAddress" role="tablist" aria-multiselectable="true">
            <div class="panel">
                <div class="panel-heading" role="tab" id="headingAddress">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordionAddress" href="#collapseAddress"
                            aria-expanded="true" aria-controls="collapseAddress">
                            Add Address
                        </a>
                    </h4>
                </div>
                <div id="collapseAddress" class="panel-collapse collapse in" role="tabpanel"
                    aria-labelledby="headingHealthcard">
                    <div class="panel-body">
                        {{ Form::open(['route' => 'admin.auth.user.create.address', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="form-group row">
                            {{ Form::label('address1', trans('Address Line 1'), ['class' => 'col-md-2 from-control-label required']) }}
                            <div class="col-md-10">
                                <div class="input-group ">
                                    <input type="text" name="address1" class="form-control" required>
                                </div>
                            </div>
                            <!--col-->
                        </div>
                        <div class="form-group row">
                            {{ Form::label('address2', trans('Address Line 2'), ['class' => 'col-md-2 from-control-label required']) }}
                            <div class="col-md-10">
                                <div class="input-group ">
                                    <input type="text" name="address2" class="form-control">
                                </div>
                            </div>
                            <!--col-->
                        </div>
                        <div class="form-group row">
                            {{ Form::label('postal_code', trans('Postal Code'), ['class' => 'col-md-2 from-control-label required']) }}
                            <div class="col-md-10">
                                <div class="input-group ">
                                    <input type="text" name="postal_code" class="form-control" required>
                                </div>
                            </div>
                            <!--col-->
                        </div>
                        <div class="form-group row">
                            {{ Form::label('city', trans('City'), ['class' => 'col-md-2 from-control-label required']) }}
                            <div class="col-md-10">
                                <div class="input-group ">
                                    <input type="text" name="city" class="form-control" required>
                                </div>
                            </div>
                            <!--col-->
                        </div>
                        <div class="form-group row">
                            {{ Form::label('address_type', trans('Address Type'), ['class' => 'col-md-2 from-control-label required']) }}

                            <div class="col-md-10">
                                @php
                                    $addresses = [
                                        'Billing Address' => 'Billing Address',
                                        'Shipping/Delivery Address' => 'Shipping/Delivery Address',
                                    ];
                                @endphp
                                {{ Form::select('address_type', $addresses, null, ['class' => 'form-control box-size', 'placeholder' => trans('Address Type'), 'required' => 'required']) }}
                            </div>
                            <!--col-->
                        </div>
                        <div class="form-group row">
                            {{ Form::label('province', trans('validation.attributes.backend.access.users.province'), ['class' => 'col-md-2 from-control-label required']) }}

                            <div class="col-md-10">
                                {{ Form::select('province', $provinces, null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.users.province'), 'required' => 'required']) }}
                            </div>
                            <!--col-->
                        </div>

                        <div class="card-footer-address">
                            <div class="row">


                                <div class="col text-right">
                                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success pull-right']) }}
                                </div><!--row-->
                            </div><!--row-->
                        </div><!--card-footer-->
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($user->address)
        @foreach ($user->address as $address)
            <div class="card card-wrapper-{{ $address->id }}">
                <div class="card-body">
                    <span class="address-delete" title="delete" onclick="delete_address('{{ $address->id }}')"><i
                            class="fa fa-trash"></i></span>
                    <span class="address-edit" title="edit" data-toggle="modal"
                        data-target="#edit-address-{{ $address->id }}"><i class="fa fa-pencil"></i></span>
                    {{-- Modal start --}}
                    <div class="modal fade" id="edit-address-{{ $address->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                {{ Form::open(['route' => 'admin.auth.user.edit.address', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

                                <div class="modal-header">
                                    <h4 class="modal-title" id="modalLabel">Edit Address</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="address_id" value="{{ $address->id }}">
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                                    <div class="form-group row">
                                        {{ Form::label('address1', trans('Address Line 1'), ['class' => 'col-md-3 from-control-label required']) }}
                                        <div class="col-md-9">
                                            <div class="input-group ">
                                                <input type="text" name="address1" class="form-control"
                                                    value="{{ $address->address1 }}" required>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('address2', trans('Address Line 2'), ['class' => 'col-md-3 from-control-label required']) }}
                                        <div class="col-md-9">
                                            <div class="input-group ">
                                                <input type="text" name="address2" class="form-control"
                                                    value="{{ $address->address2 }}">
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('postal_code', trans('Postal Code'), ['class' => 'col-md-3 from-control-label required']) }}
                                        <div class="col-md-9">
                                            <div class="input-group ">
                                                <input type="text" name="postal_code" class="form-control"
                                                    value="{{ $address->postal_code }}" required>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('city', trans('City'), ['class' => 'col-md-3 from-control-label required']) }}
                                        <div class="col-md-9">
                                            <div class="input-group ">
                                                <input type="text" name="city" class="form-control"
                                                    value="{{ $address->city }}" required>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('address_type', trans('Address Type'), ['class' => 'col-md-3 from-control-label required']) }}

                                        <div class="col-md-9">
                                            @php
                                                $addresses = [
                                                    'Billing Address' => 'Billing Address',
                                                    'Shipping/Delivery Address' => 'Shipping/Delivery Address',
                                                ];
                                            @endphp
                                            {{ Form::select('address_type', $addresses, $address->address_type, ['class' => 'form-control box-size', 'placeholder' => trans('Address Type'), 'required' => 'required']) }}
                                        </div>
                                        <!--col-->
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('province', trans('validation.attributes.backend.access.users.province'), ['class' => 'col-md-3 from-control-label required']) }}

                                        <div class="col-md-9">
                                            {{ Form::select('province', $provinces, $address->province, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.users.province'), 'required' => 'required']) }}
                                        </div>
                                        <!--col-->
                                    </div>

                                    <div class="card-footer-address">
                                        <div class="row">


                                            <div class="col text-right">
                                                {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success']) }}
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div><!--row-->
                                        </div><!--row-->
                                    </div><!--card-footer-->

                                </div>
                                {{--   <div class="modal-footer">
                                        
                                    </div> --}}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Modal end --}}
                <h4 class="card-title">{{ $user->first_name }} {{ $user->last_name }}</h4>
                <p class="card-text">
                    <span><strong>Email:</strong> {{ $user->email }}</span>
                    <span><strong>Address Line 1:</strong> {{ $address->address1 }}</span>
                    <span><strong>Address Line 1:</strong> {{ $address->address2 }}</span>
                    <span><strong>Postal Code:</strong> {{ $address->postal_code }}</span>
                    <span><strong>City:</strong> {{ $address->city }}</span>
                    <span><strong>Province:</strong> {{ $address->province }}</span>
                    <span><strong>Address Type:</strong> {{ $address->address_type }}</span>
                </p>

            </div>
        @endforeach
    @endif
</div><!--table-responsive-->
