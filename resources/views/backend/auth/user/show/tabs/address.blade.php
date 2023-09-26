<div class="col">

    <h4 class="text-center">Address Details </h4>

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
                        {{ Form::label('province', trans('validation.attributes.backend.access.users.province'), ['class' => 'col-md-2 from-control-label required']) }}

                        <div class="col-md-10">
                            {{ Form::select('province', $provinces, null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.users.province'),'required'=>'required']) }}
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


    @if ($user->address)
        @foreach ($user->address as $address)
            <div class="card card-wrapper-{{$address->id}}">
                <div class="card-body">
                    <span class="address-delete" title="delete"  onclick="delete_address('{{$address->id}}')"><i class="fa fa-trash"></i></span>
                    
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
            </div>
        @endforeach
    @endif
</div><!--table-responsive-->
<style>
    p.card-text span {
        width: 100%;
        display: flex;
    }
</style>
