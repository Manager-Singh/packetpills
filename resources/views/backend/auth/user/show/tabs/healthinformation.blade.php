<div class="col">

    <h4 class="text-center">Health Information </h4>

    <div class="panel-group wrap" id="accordionHealthinformation" role="tablist" aria-multiselectable="true">
        <div class="panel">
            <div class="panel-heading" role="tab" id="headingHealthinformation">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordionHealthinformation"
                        href="#collapseHealthinformation" aria-expanded="true"
                        aria-controls="collapseHealthinformation">
                        Add Health Information
                    </a>
                </h4>
            </div>
            <div id="collapseHealthinformation" class="panel-collapse collapse in" role="tabpanel"
                aria-labelledby="headingHealthcard">
                <div class="panel-body">
                    {{ Form::open(['route' => 'admin.auth.user.create.healthinformation', 'class' => 'form-horizontal', 'role' =>
                    'form', 'method' => 'post']) }}
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <div class="form-group row">
                        {{ Form::label('allergies', trans('Do you have allergies to any medication?'), ['class' =>
                        'col-md-2 from-control-label
                        required']) }}
                        <div class="col-md-10">
                            <div class="input-group ">
                                <label for="allergies-yes" class="control">
                                    <input type="radio" value="1" name="allergies" id="allergies-yes"
                                        class="allergies" {{ $user->healthinformation->allergies == 1 ? 'checked' : ''}}
                                    />
                                    &nbsp;&nbsp;@lang('Yes')
                                </label>&nbsp;&nbsp;
                                <label for="allergies-no" class="control">
                                    <input type="radio" value="0" name="allergies" id="allergies-no"
                                        class="allergies" {{ $user->healthinformation->allergies == 0 ? 'checked' : ''}} />
                                    &nbsp;&nbsp;@lang('No')
                                </label>
                            </div>
                        </div>
                        <!--col-->
                    </div>
                    <div class="form-group row">
                        {{ Form::label('supplements_medications', trans('Supplement & medications that you one taking'),
                        ['class' => 'col-md-2 from-control-label
                        required']) }}
                        <div class="col-md-10">
                            <div class="input-group ">
                                {{ Form::text('supplements_medications', $user->healthinformation->supplements_medications, ['class' => 'form-control',
                                'placeholder' => trans(''),'data-role'=>'tagsinput' ]) }}

                            </div>
                        </div>
                        <!--col-->
                    </div>

                    <div class="card-footer-address">
                        <div class="row">


                            <div class="col text-right">
                                {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success
                                pull-right']) }}
                            </div><!--row-->
                        </div><!--row-->
                    </div><!--card-footer-->
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>


    @if ($user->healthinformation)

    <div class="card card-wrapper">
        <div class="card-body">

            <h4 class="card-title">{{ $user->first_name }} {{ $user->last_name }}</h4>

            <div><strong>Email:</strong> {{ $user->email }}</div>
            <div><strong>Do you have allergies to any medication?:</strong>
                @if($user->healthinformation->allergies == 1)
                Yes
                @else'
                No
                @endif
            </div>
            <div><strong>Supplement & medications that you one taking:</strong>
                @if($user->healthinformation->supplements_medications)
                @php
                $supplements_medications = explode(",",$user->healthinformation->supplements_medications);
                @endphp
                @foreach($supplements_medications as $supplements_medication)
                <span class="label label-info">{{$supplements_medication}}</span>
                @endforeach

                @endif
            </div>
        </div>
    </div>
    @endif
</div><!--table-responsive-->