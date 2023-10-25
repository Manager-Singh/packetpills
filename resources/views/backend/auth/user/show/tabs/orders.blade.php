<div class="col">
    <h4 class="text-center">Orders</h4>
    @if ($orders)
        @foreach ($orders as $order)
            <div class="panel-group wrap order-myaccordion" id="medication-order-{{ $order->id }}" role="tablist"
                aria-multiselectable="true">
                <div class="panel">
                    <div class="panel-heading" role="tab" id="order-heading-{{ $order->id }}">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#medication-order-{{ $order->id }}"
                                href="#order-collapse-{{ $order->id }}" aria-expanded="true"
                                aria-controls="order-collapse-{{ $order->id }}">
                                {{ $order->order_number }} Created At
                                {{ $order->created_at }}
                            </a>
                        </h4>

                    </div>
                    <div id="order-collapse-{{ $order->id }}" class="panel-collapse collapse in" role="tabpanel"
                        aria-labelledby="order-heading-{{ $order->id }}">
                        <div class="panel-body">
                            <h4 class="text-center">Order Details</h4>
                            <div class="order-details">
                            <p>Order Number: {{ $order->order_number }}</p>
                            <p>Total Amount: ${{ $order->total_amount }}</p>
                            <p>Order Date: {{ $order->created_at }}</p>
                            <p>Order Status: {{ $order->order_status }}</p>
                            <p>Prescription Number: {{ $order->prescription->prescription_number }}</p>
                            </div>
                            <h4 class="text-center">Medication Details</h4>
                            @foreach($order->order_items as $order_item)
                            <div class="order-medication-details">
                            <p>Drug Name : {{ $order_item->medication->drug_name }}</p>
                            <p>Price : ${{ $order_item->price }}</p>
                            <p>Doctor Name : {{ $order_item->medication->prescribing_doctor }}</p>
                            </div>
                            
                            @endforeach
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
