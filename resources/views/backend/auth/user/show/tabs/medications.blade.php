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
                            <form action="{{ route('admin.auth.user.create.medication.order') }}" method="POST">
                            @csrf
                            <input type="hidden" name="prescription_id" value="{{ $prescription->id }}">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                @foreach ($prescription->medications as $medication)
                                    <div class="row medication-seprator" id="medi-{{$medication->id}}">
                                        <div class="col-md-1 from-control-label">
                                            <input type="checkbox" id="medication-iteam-{{ $medication->id }}"
                                                class="box-size custom-checkbox medication-iteam-{{ $medication->id }}"
                                                value="{{ $medication->id }}" name="medication[]">
                                        </div>
                                        <label class="col-md-8" for="medication-iteam-{{ $medication->id }}">
                                            <div class="row">
                                                <div class="col-md-2 from-control-label">Prescribing Doctor</div>
                                                <div class="col-md-10">
                                                    {{ $medication->prescribing_doctor }}
                                                </div>
                                                <div class="col-md-2 from-control-label">Drug Name</div>
                                                <div class="col-md-10">
                                                    {{ $medication->drug_name }}
                                                </div>
                                                <div class="col-md-2 from-control-label">Price</div>
                                                <div class="col-md-10">
                                                    ($) {{ $medication->price }} 
                                                </div>
                                            </div>
                                        </label>
                                        <div class="col-md-2">
                                        {!! medicationOrderStatus($medication->id) !!}
                                           
                                        </div>  
                                        <div class="col-md-1">
                                            <i class="nav-icon fas fa-trash text-danger" style="font-size:20px" onclick="medicationDeleted('{{ $medication->id }}')"></i>
                                        </div>
                                        <!--col-->
                                    </div>
                                @endforeach

                           <button class="btn btn-success mt-3">Create Order</button>
                           <form>
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
