<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class HandleAfterPaymentController extends Controller
{
    public function handle(Request $request)
    {
        $signature_key = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . config('midtrans.server_key'));


        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        $notif = new \Midtrans\Notification();
        if ($signature_key != $notif->signature_key) {
            return abort(404);
        }
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'accept') {
                    // TODO set payment status in merchant's database to 'Success'
                    Order::where('order_id', $request->order_id)->update([
                        'payment_type' => $type,
                        'bank' => $notif->bank,
                        'payment_status' => 'Paid',
                    ]);

                    $order = Order::find($notif->order_id);
                    foreach ($order->orderItems as $item) {
                        $product = Product::find($item->product_id);
                        $product->update([
                            'stock' => $product->stock - $item->quantity
                        ]);
                    }
                    echo "Transaction order_id: " . $order_id . " successfully captured using " . $type;
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            echo "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
            Order::where('order_id', $request->order_id)->update(['payment_type' => $type, 'payment_status' => 'Paid',]);
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            Order::where('order_id', $request->order_id)->update(['payment_type' => $type, 'payment_status' => 'pending']);
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            Order::where('order_id', $request->order_id)->update(['payment_type' => $type, 'payment_status' => 'deny']);
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            Order::where('order_id', $request->order_id)->update(['payment_type' => $type, 'payment_status' => 'expire']);
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            Order::where('order_id', $request->order_id)->update(['payment_type' => $type, 'payment_status' => 'cancel']);
        }
    }
}
