<div class="col">
    <h4 class="text-center">Prescription Refills Request</h4>
    @if ($prescriptionRefills)
        @foreach ($prescriptionRefills as $prescriptionRefill)
            <div class="panel-group wrap order-myaccordion" id="prescriptionRefill-{{ $prescriptionRefill->id }}" role="tablist"
                aria-multiselectable="true">
                <div class="panel">
                    <div class="panel-heading" role="tab" id="order-heading-{{ $prescriptionRefill->id }}">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#prescriptionRefill-{{ $prescriptionRefill->id }}"
                                href="#order-collapse-{{ $prescriptionRefill->id }}" aria-expanded="true"
                                aria-controls="order-collapse-{{ $prescriptionRefill->id }}">
                                {{ $prescriptionRefill->transfer_number }} Created At
                                {{ $prescriptionRefill->created_at }}
                                <div class="status-wrapper-{{ $prescriptionRefill->id }}" style="display: inline;">
                                    @if ($prescriptionRefill->status == 'pending')
                                        <span class="badge badge-warning"
                                            style="right: 29px; position: absolute;">{{ ucfirst($prescriptionRefill->status) }}</span>
                                    @elseif($prescriptionRefill->status == 'cancelled')
                                        <span class="badge badge-danger"
                                            style="right: 29px; position: absolute;">{{ ucfirst($prescriptionRefill->status) }}</span>
                                    @elseif($prescriptionRefill->status == 'approved')
                                        <span class="badge badge-success"
                                            style="right: 29px; position: absolute;">{{ ucfirst($prescriptionRefill->status) }}</span>
                                    @endif
                                </div>
                            </a>
                        </h4>

                    </div>
                    <div id="order-collapse-{{ $prescriptionRefill->id }}" class="panel-collapse collapse in" role="tabpanel"
                        aria-labelledby="order-heading-{{ $prescriptionRefill->id }}">
                        <div class="panel-body">
                            <h4 class="text-center">Prescription Details</h4>
                            <div class="order-details">
                            <p>Prescription Number: {{ $prescriptionRefill->prescription->prescription_number }}</p>
                            <p>Patient Name: {{ $prescriptionRefill->user->first_name }} {{ $prescriptionRefill->user->last_name }}</p>
                            <p>Patient Email: {{ $prescriptionRefill->user->email }}</p>
                           @php
                                $prescription_refill_status_array = [
                                'pending'=>'Pending',
                                'approved'=>'Approved',
                                'cancelled'=>'Cancelled',
                                'declined'=>'Declined',
                                'processing'=>'Processing'
                                ];
                                
                            @endphp
                            <p>Refill Status: {{ Form::select('status', $prescription_refill_status_array, $prescriptionRefill->status, ['class' => 'form-control prescripitonRefillStatus box-size','id' => 'prescripitonRefillStatus-'.$prescriptionRefill->id, 'data-placeholder' => 'Prescription Refill Status']) }}</p>
                            
                            </div>
                            
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
