@extends('layouts.app')


@section('content')
    <div class="container vh-100 w-100 d-flex flex-wrap gap-lg-10 justify-content-center align-items-center">

        @foreach ($orders as $order)
            <div class="row">
                <div class="card col-12 mx-auto py-2">
                    <h4>Invoice #</h4>
                    <p>Id: {{ $order->order_id }}</p>
                    <p>Item: {{ $order->quantity }} {{ $order->product->name }}</p>
                    <p>Amount: Rp {{ number_format($order->gross_amount, 2, ',', '.') }}</p>
                    <div>
                        <div class="badge bg-info"> {{ $order->payment_status }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
