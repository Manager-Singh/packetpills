<div class="col">
    <h4 class="text-center">Medications</h4>
    @if ($prescriptions)
        @foreach ($prescriptions as $prescription)
            <div class="panel-group wrap myaccordion" id="accordinon-{{ $prescription->id }}" role="tablist"
                aria-multiselectable="true">
                <div class="panel">
                    <div class="panel-heading" role="tab" id="heading-{{ $prescription->id }}">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordinon-{{ $prescription->id }}"
                                href="#collapse-{{ $prescription->id }}" aria-expanded="true"
                                aria-controls="collapse-{{ $prescription->id }}">
                                {{ $prescription->prescription_number }} Created At
                                {{ $prescription->created_at }}
                            </a>
                        </h4>

                    </div>
                    <div id="collapse-{{ $prescription->id }}" class="panel-collapse collapse in" role="tabpanel"
                        aria-labelledby="heading-{{ $prescription->id }}">
                        <div class="panel-body">
                            <h4 class="text-center">Medications Details</h4>
                            @foreach ($prescription->medications as $medication)
                                <div class="row medication-seprator">
                                    <div class="col-md-1 from-control-label">
                                        <input type="checkbox" id="medication-iteam-{{ $medication->id }}"
                                            class="box-size custom-checkbox medication-iteam-{{ $medication->id }}"
                                            value="{{ $medication->id }}">
                                    </div>
                                    <label class="col-md-11" for="medication-iteam-{{ $medication->id }}">
                                        <div class="row">
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
                                        </div>
                                    </label>
                                    <!--col-->
                                </div>
                            @endforeach

                           {{-- <button class="btn btn-success">Create Order</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

</div><!--table-responsive-->

@push('after-styles')
    <style>
        .myaccordion .medication-seprator:last-child {
             border-bottom: none;
        }

        .myaccordion .medication-seprator {
            border-bottom: 1px solid #f1eaea;
                padding: 12px 0px;
        }
        .myaccordion .medication-seprator:hover {
               background: #f9f5f5;
               cursor:pointer;
        }

        .custom-checkbox {
            width: 100%;
            margin-top: 35%;
        }
    </style>
@endpush
