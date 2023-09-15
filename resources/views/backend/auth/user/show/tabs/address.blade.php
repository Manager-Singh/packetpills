<div class="col">
        @if($user->address)
            @foreach($user->address as $address)
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $user->first_name }} {{ $user->last_name }}</h4>
                        <p class="card-text">
                            <span><strong>Email:</strong> {{ $user->email }}</span>
                            <span><strong>Address Line 1:</strong> {{ $address->address1 }}</span>
                            <span><strong>Address Line 1:</strong> {{ $address->address2 }}</span>
                            <span><strong>Postal Code:</strong> {{ $address->postal_code }}</span>
                            <span><strong>City:</strong> {{ $address->city }}</span>
                            <span><strong>Province:</strong> {{ $address->province }}</span>
                            <span><strong>Address Type:</strong> {{ $address->address_type }}</span>
                        </p>
                    </div>
                </div>
            @endforeach
        @endif
</div><!--table-responsive-->
<style>
    p.card-text span {
    width: 100%;
    display: flex;
}
    </style>
