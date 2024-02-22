<div class="col-md-8 blue-right-border">
    <h4 class="text-center">Prescriptions Details</h4>

    <div class="panel-group wrap" id="accordion2" role="tablist" aria-multiselectable="true">
        <div class="panel">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        Create Prescription
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    {{ Form::open([
                        'route' => 'admin.auth.user.create.prescription',
                        'class' => 'form-horizontal',
                        'role' => 'form',
                        'method' => 'post',
                        'files' => true,
                    ]) }}
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="form-group row">
                        {{ Form::label('prescription_images', trans('Prescription Images'), [
                            'class' => 'col-md-2 from-control-label required',
                        ]) }}
                        <div class="col-md-10">
                            <div class="files-wrapper prescription-wrapper">
                                <div class="file-upload files-wrapper-inner">
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
                                    onclick="add_more('prescription-wrapper','files-wrapper-inner')"> Add
                                    More</button>
                            </div><!--col-->

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


    @if (count($aaprescriptions) > 0)
  
    
        <div class="panel-group wrap" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach ($aaprescriptions as $key => $prescription)
                <div class="panel">
                    <div class="panel-heading" role="tab" id="heading-{{ $prescription->id }}">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion"
                                href="#collapse-{{ $prescription->id }}" aria-expanded="true"
                                aria-controls="collapse-{{ $prescription->id }}">
                                {{ $prescription->prescription_number }} Created At
                                {{ $prescription->created_at }}
                                <div class="status-wrapper-{{ $prescription->id }}" style="display: inline;">
                                    @if ($prescription->status == 'pending')
                                        <span class="badge badge-warning"
                                            style="right: 29px; position: absolute;">{{ ucfirst($prescription->status) }}</span>
                                    @elseif($prescription->status == 'cancelled')
                                        <span class="badge badge-danger"
                                            style="right: 29px; position: absolute;">{{ ucfirst($prescription->status) }}</span>
                                    @elseif($prescription->status == 'approved')
                                        <span class="badge badge-success"
                                            style="right: 29px; position: absolute;">{{ ucfirst($prescription->status) }}</span>
                                    @endif
                                </div>
                            </a>

                        </h4>
                    </div>
                    <div id="collapse-{{ $prescription->id }}" class="panel-collapse collapse in" role="tabpanel"
                        aria-labelledby="heading-{{ $prescription->id }}">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                               
                                    @if ($prescription->status == 'pending')
                                        @php
                                            $approve = 'block';
                                            $cancel = 'block';
                                            $ap = 92;
                                            $cp =29;
                                        @endphp
                                       
                                    @elseif($prescription->status == 'approved')
                                        @php
                                            $approve = 'none';
                                            $cancel = 'block';
                                            $ap = 29;
                                            $cp =29;
                                        @endphp
                                      
                                    @elseif($prescription->status == 'cancelled')
                                        @php
                                            $approve = 'block';
                                            $cancel = 'none';
                                            $ap = 29;
                                            $cp =29;
                                        @endphp
                                    
                                    @endif

                                     <span class="badge badge-success approve-{{ $prescription->id }}"
                                            style="right: {{$ap}}px; position: absolute; padding: 9px;cursor: pointer; display:{{$approve}}"
                                            onclick="change_status('{{ $prescription->id }}','Approve')">Approve</span>
                                        <span class="badge badge-danger cancel-{{ $prescription->id }}"
                                            style="right: {{$cp}}px; position: absolute; padding: 9px;cursor: pointer; display:{{$cancel}}"
                                            onclick="change_status('{{ $prescription->id }}','Cancel')">Cancel</span>

                                </div>
                            </div>
                            @if (count($prescription->prescription_iteams) > 0)
                                <h5 class="prescription-heading">Prescription Images</h5>
                                <div class="gallery-wrapper">
                                    @foreach ($prescription->prescription_iteams as $iteam => $prescription_iteam)
                                        <div class="image-wrapper">
                                            <a
                                                href="#lightbox-image-{{ $prescription_iteam->prescripiton_id }}-{{ $prescription_iteam->page_no }}">
                                                    @if(Str::lower(pathinfo($prescription_iteam->prescription_upload, PATHINFO_EXTENSION)) === 'pdf')
                                                        <img src="{{ asset('img/pdf.png') }}" alt="{{ $prescription_iteam->page_no }}" />
                                                    @else
                                                        <img src="{{ asset($prescription_iteam->prescription_upload) }}" alt="{{ $prescription_iteam->page_no }}" />
                                                    @endif
                                                    
                                                <div class="image-title">Prescription page No.
                                                    {{ $prescription_iteam->page_no }}
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="gallery-lightboxes">
                                    @foreach ($prescription->prescription_iteams as $iteam => $prescription_iteam_for_modal)
                                        <div class="image-lightbox"
                                            id="lightbox-image-{{ $prescription_iteam_for_modal->prescripiton_id }}-{{ $prescription_iteam_for_modal->page_no }}">
                                            <div class="image-lightbox-wrapper">
                                                <a href="#" class="close"></a>
                                                <!-- <a href="#lightbox-image-{{ $prescription_iteam_for_modal->page_no + 1 }}" class="arrow-left"></a>
                                                    <a href="#lightbox-image-{{ $prescription_iteam_for_modal->page_no - 1 }}" class="arrow-right"></a> -->
                                                

                                                @if(Str::lower(pathinfo($prescription_iteam_for_modal->prescription_upload, PATHINFO_EXTENSION)) === 'pdf')
                                                    <iframe src="{{ asset($prescription_iteam_for_modal->prescription_upload) }}" style="width: 100%; height: 390px; margin-top:10px" frameborder="0"></iframe>
                                                @else
                                                    <img src="{{ asset($prescription_iteam_for_modal->prescription_upload) }}"  class="img-fluid">
                                                @endif
                                                <div class="image-title">Prescription page No.
                                                    {{ $prescription_iteam_for_modal->page_no }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="medication-form-{{ $prescription->id }}" style="display:{{ $prescription->status == 'pending' || $prescription->status == 'cancelled' ? "none" : "block" }}">
                                    <h5 class="prescription-heading">Medications</h5>

                                    <div class="panel panel-default">

                                        <div class="panel-body">

                                            <form action="{{ route('admin.auth.user.create.medication') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="prescription_id"
                                                    value="{{ $prescription->id }}">
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <div class="row">
                                                    <div class="col-sm-12 nopadding">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                name="prescribing_doctor" value=""
                                                                placeholder="Prescribing Doctor" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row main-idv">
                                                    <div class="col-sm-3 nopadding">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="drug[]" value="" placeholder="Drug Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 nopadding">
                                                        <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control"
                                                                name="price[]" value=""
                                                                placeholder="Drug Price" required min="1"
                                                                tep="1">
                                                                 <div class="input-group-btn">
                                                                    <button class="btn btn-success" type="button"
                                                                        onclick="education_fields('{{ $prescription->id }}')">
                                                                        <span class="fa fa-plus"
                                                                            aria-hidden="true"></span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="clear"></div>
                                                </div>
                                                <div id="education_fields-{{ $prescription->id }}">

                                                </div>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            @else
                                <p>Prescription images not added!</p>
                            @endif

                        </div>
                    </div>
                </div>
                <!-- end of panel -->
            @endforeach


        </div>
    @else
        <p>Prescriptions not added!</p>
    @endif
</div>
