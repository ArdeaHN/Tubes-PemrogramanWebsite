@extends('layouts.app')


@section('content')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>



    <div class="container vh-100 w-100 d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="card col-12 mx-auto py-2">
                <h4>Pembayaran</h4>
                <h5>Item</h5>
                <p>Id: {{ $order->order_id }}</p>
                <p>Amount: Rp {{ number_format($order->gross_amount, 2, ',', '.') }}</p>
                <button class="btn btn-info" id="pay-button">Bayar</button>
            </div>
        </div>
    </div>
    </div>

    <script>
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    window.location = '/order';
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
@endsection
