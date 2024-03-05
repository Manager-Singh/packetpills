<div class="col">
    <h4 class="text-center">Transfer Requests</h4>
    @if ($transferRequests)
        @foreach ($transferRequests as $transferRequest)
            <div class="panel-group wrap order-myaccordion" id="transferRequest-{{ $transferRequest->id }}" role="tablist"
                aria-multiselectable="true">
                <div class="panel">
                    <div class="panel-heading" role="tab" id="order-heading-{{ $transferRequest->id }}">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#transferRequest-{{ $transferRequest->id }}"
                                href="#order-collapse-{{ $transferRequest->id }}" aria-expanded="true"
                                aria-controls="order-collapse-{{ $transferRequest->id }}">
                                {{ $transferRequest->transfer_number }} Created At
                                {{ $transferRequest->created_at }}
                                <div class="status-wrapper-{{ $transferRequest->id }}" style="display: inline;">
                                    @if ($transferRequest->status == 'pending')
                                        <span class="badge badge-warning"
                                            style="right: 29px; position: absolute;">{{ ucfirst($transferRequest->status) }}</span>
                                    @elseif($transferRequest->status == 'cancelled')
                                        <span class="badge badge-danger"
                                            style="right: 29px; position: absolute;">{{ ucfirst($transferRequest->status) }}</span>
                                    @elseif($transferRequest->status == 'approved')
                                        <span class="badge badge-success"
                                            style="right: 29px; position: absolute;">{{ ucfirst($transferRequest->status) }}</span>
                                    @endif
                                </div>
                            </a>
                        </h4>

                    </div>
                    <div id="order-collapse-{{ $transferRequest->id }}" class="panel-collapse collapse in" role="tabpanel"
                        aria-labelledby="order-heading-{{ $transferRequest->id }}">
                        <div class="panel-body">
                            <h4 class="text-center">Transfer Details</h4>
                            <div class="order-details">
                            <p>Transfer Number: {{ $transferRequest->transfer_number }}</p>
                            <p>Pharmacy Name: {{ $transferRequest->name }}</p>
                            <p>Pharmacy Address: {{ $transferRequest->formatted_address }}</p>
                            <p>Phone Number: {{ $transferRequest->formatted_phone_number }}</p>
                            @php
                                $transfer_request_status_array = [
                                'pending'=>'Pending',
                                'approved'=>'Approved',
                                'cancelled'=>'Cancelled',
                                'declined'=>'Declined',
                                'processing'=>'Processing'
                                ];
                                
                            @endphp
                            <p>Transfer Status: {{ Form::select('status', $transfer_request_status_array, $transferRequest->status, ['class' => 'form-control transferStatus box-size','id' => 'transferStatus-'.$transferRequest->id, 'data-placeholder' => trans('Transfer Status')]) }}</p>
                            
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
