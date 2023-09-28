<div class="col">
 <h4 class="text-center">Insurance Details</h4>
    @if ($user->insurance)
        <div class="panel-group wrap" id="accordionprimaryInsurance" role="tablist" aria-multiselectable="true">
            <div class="panel">
                <div class="panel-heading" role="tab" id="headingprimaryInsurance">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordionprimaryInsurance"
                            href="#collapseprimaryInsurance" aria-expanded="true"
                            aria-controls="collapseprimaryInsurance">
                            Primary Insurance
                        </a>
                    </h4>
                </div>
                <div id="collapseprimaryInsurance" class="panel-collapse collapse in" role="tabpanel"
                    aria-labelledby="headingprimaryInsurance">
                    <div class="panel-body">
                        {{ Form::open(['route' => 'admin.auth.user.create.insurance', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => true]) }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="type" value="primary">

                        <div class="form-group row">
                            {{ Form::label('healthcard_images', trans('Health card Images'), ['class' => 'col-md-2 from-control-label required']) }}
                            <div class="col-md-10">
                                <div class="files-wrapper primary-wrapper">
                                    <div class="file-upload primary-wrapper-inner">
                                        <div class="file-select file-select-box">
                                            <div class="imagePreview"></div>
                                            <button class="file-upload-custom-btn" type="button"><i
                                                    class="fa fa-plus"></i></button>
                                            <input type="file" name="files[]" class="profileimg" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--col-->
                        </div>
                        <div class="card-footer-prescription">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="add-more btn btn-info"
                                        onclick="add_more('primary-wrapper','primary-wrapper-inner',2)"> Add
                                        More</button>
                                </div><!--col-->

                                <div class="col text-right">
                                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success pull-right']) }}
                                </div><!--row-->
                            </div><!--row-->
                        </div><!--card-footer-->
                        {{ Form::close() }}
                    </div>
                    @foreach ($user->primaryInsurance as $pinsurance)
                        <div class="col">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('/') . $pinsurance->front_img }}"
                                            alt="Bologna" height=300>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('/') . $pinsurance->back_img }}"
                                            alt="Bologna" height=300>
                                    </div>
                                </div>
                            </div>
                        </div><!--table-responsive-->
                    @endforeach
                </div>
            </div>
        </div>


    @endif
    @if ($user->secondaryInsurance)
        <div class="panel-group wrap" id="accordionsecondaryInsurance" role="tablist" aria-multiselectable="true">
            <div class="panel">
                <div class="panel-heading" role="tab" id="headingsecondaryInsurance">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordionsecondaryInsurance"
                            href="#collapsesecondaryInsurance" aria-expanded="true"
                            aria-controls="collapsesecondaryInsurance">
                            Secondary Insurance
                        </a>
                    </h4>
                </div>
                <div id="collapsesecondaryInsurance" class="panel-collapse collapse in" role="tabpanel"
                    aria-labelledby="headingsecondaryInsurance">
                    <div class="panel-body">
                        {{ Form::open(['route' => 'admin.auth.user.create.insurance', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => true]) }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="type" value="secondary">

                        <div class="form-group row">
                            {{ Form::label('healthcard_images', trans('Health card Images'), ['class' => 'col-md-2 from-control-label required']) }}
                            <div class="col-md-10">
                                <div class="files-wrapper secondary-wrapper">
                                    <div class="file-upload secondary-wrapper-inner">
                                        <div class="file-select file-select-box">
                                            <div class="imagePreview"></div>
                                            <button class="file-upload-custom-btn" type="button"><i
                                                    class="fa fa-plus"></i></button>
                                            <input type="file" name="files[]" class="profileimg" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--col-->
                        </div>
                        <div class="card-footer-prescription">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="add-more btn btn-info"
                                        onclick="add_more('secondary-wrapper','secondary-wrapper-inner',2)"> Add
                                        More</button>
                                </div><!--col-->

                                <div class="col text-right">
                                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success pull-right']) }}
                                </div><!--row-->
                            </div><!--row-->
                        </div><!--card-footer-->
                        {{ Form::close() }}
                    </div>
                    @foreach ($user->secondaryInsurance as $sinsurance)
                        <div class="col">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('/') . $sinsurance->front_img }}"
                                            alt="Bologna" height=300>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('/') . $sinsurance->back_img }}"
                                            alt="Bologna" height=300>
                                    </div>
                                </div>
                            </div>
                        </div><!--table-responsive-->
                    @endforeach
                </div>
            </div>
        </div>

    @endif
    @if ($user->ternaryInsurance)
        <div class="panel-group wrap" id="accordionternaryInsurance" role="tablist" aria-multiselectable="true">
            <div class="panel">
                <div class="panel-heading" role="tab" id="headingternaryInsurance">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordionternaryInsurance"
                            href="#collapseternaryInsurance" aria-expanded="true"
                            aria-controls="collapseternaryInsurance">
                            Ternary Insurance
                        </a>
                    </h4>
                </div>
                <div id="collapseternaryInsurance" class="panel-collapse collapse in" role="tabpanel"
                    aria-labelledby="headingternaryInsurance">
                    <div class="panel-body">
                        {{ Form::open(['route' => 'admin.auth.user.create.insurance', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => true]) }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="type" value="ternary">

                        <div class="form-group row">
                            {{ Form::label('healthcard_images', trans('Health card Images'), ['class' => 'col-md-2 from-control-label required']) }}
                            <div class="col-md-10">
                                <div class="files-wrapper ternary-wrapper">
                                    <div class="file-upload ternary-wrapper-inner">
                                        <div class="file-select file-select-box">
                                            <div class="imagePreview"></div>
                                            <button class="file-upload-custom-btn" type="button"><i
                                                    class="fa fa-plus"></i></button>
                                            <input type="file" name="files[]" class="profileimg" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--col-->
                        </div>
                        <div class="card-footer-prescription">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="add-more btn btn-info"
                                        onclick="add_more('ternary-wrapper','ternary-wrapper-inner',2)"> Add
                                        More</button>
                                </div><!--col-->

                                <div class="col text-right">
                                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success pull-right']) }}
                                </div><!--row-->
                            </div><!--row-->
                        </div><!--card-footer-->
                        {{ Form::close() }}
                    </div>
                    @foreach ($user->ternaryInsurance as $tinsurance)
                        <div class="col">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('/') . $tinsurance->front_img }}"
                                            alt="Bologna" height=300>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('/') . $tinsurance->back_img }}"
                                            alt="Bologna" height=300>
                                    </div>
                                </div>
                            </div>
                        </div><!--table-responsive-->
                    @endforeach
                </div>
            </div>
        </div>

    @endif
    @if ($user->quandaryInsurance)
        <div class="panel-group wrap" id="accordionquandaryInsurance" role="tablist" aria-multiselectable="true">
            <div class="panel">
                <div class="panel-heading" role="tab" id="headingquandaryInsurance">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordionquandaryInsurance"
                            href="#collapsequandaryInsurance" aria-expanded="true"
                            aria-controls="collapsequandaryInsurance">
                            Quandary Insurance
                        </a>
                    </h4>
                </div>
                <div id="collapsequandaryInsurance" class="panel-collapse collapse in" role="tabpanel"
                    aria-labelledby="headingquandaryInsurance">
                    <div class="panel-body">
                        {{ Form::open(['route' => 'admin.auth.user.create.insurance', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => true]) }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="type" value="quandary">

                        <div class="form-group row">
                            {{ Form::label('healthcard_images', trans('Health card Images'), ['class' => 'col-md-2 from-control-label required']) }}
                            <div class="col-md-10">
                                <div class="files-wrapper quandary-wrapper">
                                    <div class="file-upload quandary-wrapper-inner">
                                        <div class="file-select file-select-box">
                                            <div class="imagePreview"></div>
                                            <button class="file-upload-custom-btn" type="button"><i
                                                    class="fa fa-plus"></i></button>
                                            <input type="file" name="files[]" class="profileimg" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--col-->
                        </div>
                        <div class="card-footer-prescription">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="add-more btn btn-info"
                                        onclick="add_more('quandary-wrapper','quandary-wrapper-inner',2)"> Add
                                        More</button>
                                </div><!--col-->

                                <div class="col text-right">
                                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success pull-right']) }}
                                </div><!--row-->
                            </div><!--row-->
                        </div><!--card-footer-->
                        {{ Form::close() }}
                    </div>
                    @foreach ($user->quandaryInsurance as $qinsurance)
                        <div class="col">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('/') . $qinsurance->front_img }}"
                                            alt="Bologna" height=300>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('/') . $qinsurance->back_img }}"
                                            alt="Bologna" height=300>
                                    </div>
                                </div>
                            </div>
                        </div><!--table-responsive-->
                    @endforeach
                </div>
            </div>
        </div>

    @endif
</div><!--table-responsive-->
