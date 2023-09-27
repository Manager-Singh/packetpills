<div class="col">

    <h4 class="text-center">Payment Methods </h4>

    <div class="panel-group wrap" id="accordionPaymentmethod" role="tablist" aria-multiselectable="true">
        <div class="panel">
            <div class="panel-heading" role="tab" id="headingPaymentmethod">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordionPaymentmethod"
                        href="#collapsePaymentmethod" aria-expanded="true" aria-controls="collapsePaymentmethod">
                        Add Payment Method
                    </a>
                </h4>
            </div>
            <div id="collapsePaymentmethod" class="panel-collapse collapse in" role="tabpanel"
                aria-labelledby="headingHealthcard">
                <div class="panel-body">
                    {{ Form::open([
                        'route' => 'admin.auth.user.create.paymentmethod',
                        'class' => 'form-horizontal',
                        'role' => 'form',
                        'method' => 'post',
                    ]) }}
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <div class="form-group row">
                        {{ Form::label('card_number', trans('Card Number'), [
                            'class' => 'col-md-2 from-control-label
                                                                                                required',
                        ]) }}
                        <div class="col-md-10">
                            <div class="input-group ">
                                {{ Form::text('card_number', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('Card Number'),
                                ]) }}

                            </div>
                        </div>
                        <!--col-->
                    </div>
                    <div class="form-group row">
                        {{ Form::label('cardholder_name', trans('Card Holder Name'), [
                            'class' => 'col-md-2 from-control-label
                                                                                                required',
                        ]) }}
                        <div class="col-md-10">
                            <div class="input-group ">
                                {{ Form::text('cardholder_name', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('Card Holder Name'),
                                ]) }}

                            </div>
                        </div>
                        <!--col-->
                    </div>
                    <div class="form-group row">
                        {{ Form::label('expiry_date', trans('Expiry Date'), [
                            'class' => 'col-md-2 from-control-label
                                                                                                required',
                        ]) }}
                        <div class="col-md-10">
                            <div class="input-group ">
                                {{ Form::text('expiry_date', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('Expiry Date'),
                                ]) }}

                            </div>
                        </div>
                        <!--col-->
                    </div>
                    <div class="form-group row">
                        {{ Form::label('cvc', trans('CVC'), [
                            'class' => 'col-md-2 from-control-label
                                                                                                required',
                        ]) }}
                        <div class="col-md-10">
                            <div class="input-group ">
                                {{ Form::text('cvc', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('CVC'),
                                ]) }}

                            </div>
                        </div>
                        <!--col-->
                    </div>


                    <div class="card-footer-address">
                        <div class="row">


                            <div class="col text-right">
                                {{ Form::submit(trans('buttons.general.crud.create'), [
                                    'class' => 'btn btn-success
                                                                                                                                pull-right',
                                ]) }}
                            </div><!--row-->
                        </div><!--row-->
                    </div><!--card-footer-->
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>


    @if ($user->paymentmethod)
        @foreach ($user->paymentmethod as $pmethod)
            <div class="card card-wrapper-pmethod-{{ $pmethod->id }}">
                <div class="card-body">
                    <span class="address-delete" title="delete" onclick="delete_pmethod('{{ $pmethod->id }}')"><i
                            class="fa fa-trash"></i></span>
                    <span class="address-edit" title="edit" data-toggle="modal"
                        data-target="#edit-pmethod-{{ $pmethod->id }}"><i class="fa fa-pencil"></i></span>
                    {{-- Modal start --}}
                    <div class="modal fade" id="edit-pmethod-{{ $pmethod->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                {{ Form::open(['route' => 'admin.auth.user.edit.paymentmethod', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

                                <div class="modal-header">
                                    <h4 class="modal-title" id="modalLabel">Edit Address</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="payment_method_id" value="{{ $pmethod->id }}">
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">


                                    <div class="form-group row">
                                        {{ Form::label('card_number', trans('Card Number'), [
                                            'class' => 'col-md-2 from-control-label
                                                                                                                required',
                                        ]) }}
                                        <div class="col-md-10">
                                            <div class="input-group ">
                                                {{ Form::text('card_number', $pmethod->card_number, [
                                                    'class' => 'form-control',
                                                    'placeholder' => trans('Card Number'),
                                                ]) }}

                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('cardholder_name', trans('Card Holder Name'), [
                                            'class' => 'col-md-2 from-control-label
                                                                                                                required',
                                        ]) }}
                                        <div class="col-md-10">
                                            <div class="input-group ">
                                                {{ Form::text('cardholder_name', $pmethod->cardholder_name, [
                                                    'class' => 'form-control',
                                                    'placeholder' => trans('Card Holder Name'),
                                                ]) }}

                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('expiry_date', trans('Expiry Date'), [
                                            'class' => 'col-md-2 from-control-label
                                                                                                                required',
                                        ]) }}
                                        <div class="col-md-10">
                                            <div class="input-group ">
                                                {{ Form::text('expiry_date', $pmethod->expiry_date, [
                                                    'class' => 'form-control',
                                                    'placeholder' => trans('Expiry Date'),
                                                ]) }}

                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('cvc', trans('CVC'), [
                                            'class' => 'col-md-2 from-control-label
                                                                                                                required',
                                        ]) }}
                                        <div class="col-md-10">
                                            <div class="input-group ">
                                                {{ Form::text('cvc', $pmethod->cvc, [
                                                    'class' => 'form-control',
                                                    'placeholder' => trans('CVC'),
                                                ]) }}

                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>

                                    <div class="card-footer-address">
                                        <div class="row">


                                            <div class="col text-right">
                                                {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-success']) }}
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
                    <span><strong>Card Number:</strong> {{ $pmethod->card_number }}</span>
                    <span><strong>Card Holder Name:</strong> {{ $pmethod->cardholder_name }}</span>
                    <span><strong>Expiry Date:</strong> {{ $pmethod->expiry_date }}</span>
                    <span><strong>CVC:</strong> {{ $pmethod->cvc }}</span>
                </p>

            </div>
        @endforeach
    @endif
</div><!--table-responsive-->
