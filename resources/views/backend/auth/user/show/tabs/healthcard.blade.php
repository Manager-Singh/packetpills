<div class="col">

  <h4 class="text-center">Healthcard Details </h4>

        <div class="panel-group wrap" id="accordionHealthcard" role="tablist" aria-multiselectable="true">
            <div class="panel">
                <div class="panel-heading" role="tab" id="headingHealthcard">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordionHealthcard" href="#collapseHealthcard"
                            aria-expanded="true" aria-controls="collapseHealthcard">
                            Create Health card
                        </a>
                    </h4>
                </div>
                <div id="collapseHealthcard" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingHealthcard">
                    <div class="panel-body">
                        {{ Form::open(['route' => 'admin.auth.user.create.healthcard', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => true]) }}
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        
                        <div class="form-group row">
                            {{ Form::label('healthcard_number', trans('Health card Number'), ['class' => 'col-md-2 from-control-label required']) }}
                            <div class="col-md-10">
                                <div class="input-group ">
                                        <input type="text" name="healthcard_number" class="form-control">
                                </div>
                            </div>
                            <!--col-->
                        </div>
                        <div class="form-group row">
                            {{ Form::label('healthcard_images', trans('Health card Images'), ['class' => 'col-md-2 from-control-label required']) }}
                            <div class="col-md-10">
                                <div class="files-wrapper healthcard-wrapper">
                                    <div class="file-upload healthcard-wrapper-inner">
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
                        <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="odsp" type="checkbox" id="inlineCheckbox1" value="ODSP" {{(($user->healthcard && isset($user->healthcard->odsp)) && $user->healthcard->odsp == 'ODSP') ? 'checked' : ''}}>
                            <label class="form-check-label" for="inlineCheckbox1">ODSP</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="ohip" type="checkbox" id="inlineCheckbox2" value="OHIP+  (under 25 year old Ontario Program)" {{(($user->healthcard && isset($user->healthcard->ohip)) && $user->healthcard->ohip == 'OHIP+  (under 25 year old Ontario Program)') ? 'checked' : ''}}>
                            <label class="form-check-label" for="inlineCheckbox2">OHIP+  (under 25 year old Ontario Program)</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="trillium_program" type="checkbox" id="inlineCheckbox3" value="Trillium program" {{(($user->healthcard && isset($user->healthcard->trillium_program)) && $user->healthcard->trillium_program == 'Trillium program') ? 'checked' : ''}}>
                            <label class="form-check-label" for="inlineCheckbox3">Trillium program</label>
                        </div>
                        </div>
                        <div class="card-footer-prescription">
                          <div class="row">
                              <div class="col">
                                <button type="button" class="add-more btn btn-info" onclick="add_more('healthcard-wrapper','healthcard-wrapper-inner',2)"> Add
                                  More</button>
                              </div><!--col-->
                      
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


    @if ($user->healthcard)
        <div class="row">
        <div class="col-md-12 mb-3">
        <p>Health card No: {{$user->healthcard->card_number}}</p>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="odsp" type="checkbox" id="inlineCheckbox1" value="ODSP" {{(($user->healthcard && isset($user->healthcard->odsp)) && $user->healthcard->odsp == 'ODSP') ? 'checked' : ''}}>
            <label class="form-check-label" for="inlineCheckbox1">ODSP</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="ohip" type="checkbox" id="inlineCheckbox2" value="OHIP+  (under 25 year old Ontario Program)" {{(($user->healthcard && isset($user->healthcard->ohip)) && $user->healthcard->ohip == 'OHIP+  (under 25 year old Ontario Program)') ? 'checked' : ''}}>
            <label class="form-check-label" for="inlineCheckbox2">OHIP+  (under 25 year old Ontario Program)</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="trillium_program" type="checkbox" id="inlineCheckbox3" value="Trillium program" {{(($user->healthcard && isset($user->healthcard->trillium_program)) && $user->healthcard->trillium_program == 'Trillium program') ? 'checked' : ''}}>
            <label class="form-check-label" for="inlineCheckbox3">Trillium program</label>
        </div>
        
        </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('/') . $user->healthcard->front_img }}" alt="Bologna"
                        height=300>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('/') . $user->healthcard->back_img }}" alt="Bologna"
                        height=300>
                </div>
            </div>
        </div>
    @else
        <p>Healthcard images not added!</p>
    @endif

</div><!--table-responsive-->
