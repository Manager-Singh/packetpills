<div class="col">
    <h4 class="text-center">Existing Prescription Refill Requests</h4>
    @if ($existingPrescriptions)
        @foreach ($existingPrescriptions as $existingPrescription)
            <div class="panel-group wrap order-myaccordion" id="prescriptionRefill-{{ $existingPrescription->id }}" role="tablist"
                aria-multiselectable="true">
                <div class="panel">
                    <div class="panel-heading" role="tab" id="order-heading-{{ $existingPrescription->id }}">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#prescriptionRefill-{{ $existingPrescription->id }}"
                                href="#order-collapse-{{ $existingPrescription->id }}" aria-expanded="true"
                                aria-controls="order-collapse-{{ $existingPrescription->id }}">
                                {{ $existingPrescription->prescription_number }} Created At
                                {{ $existingPrescription->created_at }}
                                <div class="status-wrapper-{{ $existingPrescription->id }}" style="display: inline;">
                                    @if ($existingPrescription->status == 'Declined')
                                        <span class="badge badge-warning"
                                            style="right: 29px; position: absolute;">{{ ucfirst($existingPrescription->status) }}</span>
                                    @elseif($existingPrescription->status == 'In Progress')
                                        <span class="badge badge-info"
                                            style="right: 29px; position: absolute;">{{ ucfirst($existingPrescription->status) }}</span>
                                    @elseif($existingPrescription->status == 'Approved')
                                        <span class="badge badge-success"
                                            style="right: 29px; position: absolute;">{{ ucfirst($existingPrescription->status) }}</span>
                                    @elseif($existingPrescription->status == 'active')
                                        <span class="badge badge-success"
                                            style="right: 29px; position: absolute;">{{ ucfirst($existingPrescription->status) }}</span>
                                    @else
                                        <span class="badge badge-info"
                                            style="right: 29px; position: absolute;">{{ ucfirst($existingPrescription->status) }}</span>
                                    @endif
                                </div>
                            </a>
                        </h4>

                    </div>
                    <div id="order-collapse-{{ $existingPrescription->id }}" class="panel-collapse collapse in" role="tabpanel"
                        aria-labelledby="order-heading-{{ $existingPrescription->id }}">
                        <div class="panel-body">
                            <h4 class="text-center">Existing Prescription Details</h4>
                            <div class="order-details">
                                <div class="row">
                                    <div class="col-md-6">
                            <p>Prescription Number: {{ $existingPrescription->prescription_number }}</p>
                            <p>Medication Name: {{ $existingPrescription->medication_name }} </p>
                            @php
                                $existing_refill_status_array = [
                                'active'=>'Active',
                                'In Progress'=>'In Progress',
                                'Declined'=>'Declined',
                                'Approved'=>'Approved',
                                'Complete'=>'Complete',
                                'Request sent to doctor for refill authorization'=>'Request sent to doctor for refill authorization',
                                'Payment Pending'=>'Payment Pending',
                                ];
                            @endphp
                            <p>Status: {{ Form::select('existing_refill_status', $existing_refill_status_array, $existingPrescription->status, ['class' => 'form-control existingRefillStatus box-size','id' => 'existingRefillStatus-'.$existingPrescription->id, 'data-placeholder' => 'Existing Refill Status']) }}</p>
                                    </div>
                                    <div class="col-md-6">
                                    <p>Image: </p>
                                    {{-- @if(isset($existingPrescription->image) && !empty($existingPrescription->image))
                                    <img  width="400" height="250" src="{{asset($existingPrescription->image)}}" />
                                    
                                    @else

                                    <strong>No Image Uploaded.</strong>
                                    
                                    @endif --}}
                                    @php
                                    $fileExtension =
                                        pathinfo($existingPrescription->image, PATHINFO_EXTENSION) ?? '';
                                @endphp

                                @if (isset($existingPrescription->image) && !empty($existingPrescription->image))
                                    @if (strtolower($fileExtension) === 'pdf')
                                        <img width="400" height="250" src="{{ asset('img/pdf.png') }}"
                                            alt="PDF File" />
                                        <br>
                                        <a href="{{ asset($existingPrescription->image) }}"
                                            target="_blank">View PDF</a>
                                    @else
                                        <img width="400" height="250"
                                            src="{{ asset($existingPrescription->image) }}"
                                            alt="Uploaded Image" />
                                    @endif
                                @else
                                    <strong>No Image Uploaded.</strong>
                                @endif
                                   
                                
                                </div>


                                </div>
                            
                            

                            
                           @php
                                $prescription_refill_status_array = [
                                'pending'=>'Pending',
                                'approved'=>'Approved',
                                'cancelled'=>'Cancelled',
                                'declined'=>'Declined',
                                'processing'=>'Processing'
                                ];
                                
                            @endphp
                            <!-- <p>Refill Status: {{ Form::select('status', $prescription_refill_status_array, $existingPrescription->status, ['class' => 'form-control prescripitonRefillStatus box-size','id' => 'prescripitonRefillStatus-'.$existingPrescription->id, 'data-placeholder' => 'Prescription Refill Status']) }}</p>
                             -->
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
