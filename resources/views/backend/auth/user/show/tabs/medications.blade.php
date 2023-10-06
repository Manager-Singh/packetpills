<div class="col">
    <h4 class="text-center">Medications Details</h4>
    @if ($user->medications)
        @foreach ($user->medications as $medication)
            <div class="panel-group wrap myaccordion" id="accordinon-{{ $medication->id }}" role="tablist"
                aria-multiselectable="true">
                <div class="panel">
                    <div class="panel-heading" role="tab" id="heading-{{ $medication->id }}">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordinon-{{ $medication->id }}"
                                href="#collapse-{{ $medication->id }}" aria-expanded="true"
                                aria-controls="collapse-{{ $medication->id }}">
                                {{ $medication->drug->brand_name }}
                                <p class="sub-heading">"{{ $medication->drug->main_therapeutic_use }}"</p>
                            </a>
                        </h4>
                        
                    </div>
                    <div id="collapse-{{ $medication->id }}" class="panel-collapse collapse in" role="tabpanel"
                        aria-labelledby="heading-{{ $medication->id }}">
                        <div class="panel-body">
                            <div class="form-group row">
                                <div class="col-md-2 from-control-label">Automatically refil this medication ?</div>
                                <div class="col-md-10">
                                   {{-- <div class="checkbox d-flex align-items-center">
                                        <label class="switch switch-label switch-pill switch-refil mr-2"
                                            for="role-1"><input class="switch-input" type="checkbox" name="status"
                                                id="role-1" value="{{ $medication->automatic_refil }}"
                                                {{ !isset($medication->automatic_refil) || (isset($medication->automatic_refil) && $medication->automatic_refil === 1) ? 'checked' : '' }}><span
                                                class="switch-slider" data-checked="Yes"
                                                data-unchecked="No"></span></label>
                                    </div> --}}
                                </div>
                                 <div class="col-md-2 from-control-label">Prescribing Doctor</div>
                                <div class="col-md-10">
                                    {{ $medication->prescribing_doctor }}
                                </div>
                                <div class="col-md-2 from-control-label">Quantity Left</div>
                                <div class="col-md-10">
                                    {{ $medication->qty_left }} Unit(s)
                                   {{-- $medication->drug->packSize->name --}}
                                </div>
                                 <div class="col-md-2 from-control-label">Quantity Filled</div>
                                <div class="col-md-10">
                                    {{ $medication->qty_filled }} Unit(s)
                                </div>
                                  <div class="col-md-2 from-control-label">Pharmacy</div>
                                <div class="col-md-10">
                                    {{ $medication->pharmacy }}
                                </div>
                                <!--col-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

</div><!--table-responsive-->
