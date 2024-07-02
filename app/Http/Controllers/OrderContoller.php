<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderContoller extends Controller
{
    public function store($product)
    {
        try {
            $product = Product::find($product);
            $order = new Order();
            $order->order_id = (string) Str::uuid();
            $order->product_id = $product->id;
            $order->user_id = Auth::user()->id;
            $order->quantity = 1;
            $order->gross_amount = $order->quantity * $product->price;


            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => $order->order_id,
                    'gross_amount' => $order->gross_amount,
                ),
                'item_details' => array([
                    'id' => $product->id,
                    'price' => $product->price,
                    'quantity' => $order->quantity,
                    'name' => $product->name
                ]),
                'customer_details' => array(
                    'first_name' => Auth::user()->first_name,
                    'last_name' => Auth::user()->first_name,
                    'email' => Auth::user()->email,
                    'phone' => '08111222333',
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $order->snapToken = $snapToken;
            $order->save();

            return view('buyer.pages.payment', compact('snapToken', 'order'));
        } catch (\Exception $e) {
            Log::channel('file')->error($e->getMessage(), ['user' => Auth::user()->first_name]);
            alert('Terjadi Kesalahan', 'Pemesanan tidak dapat dilakukan', 'warning');
            return redirect()->back();
        }
    }


    public function checkout(Request $request)
    {

        try {
            DB::beginTransaction();
            $items = Auth::user()->cartItems;

            $gross_amount = Session::get('grandTotal') ? Session::get('grandTotal') :  CartItem::getSubtotal(Auth::user());
            $coupon_code = Session::get('couponCode');
            $order = new Order();
            $order->order_id = (string) Str::uuid();
            $order->user_id = Auth::user()->id;
            $order->gross_amount = $gross_amount;
            $order->coupon_code = $coupon_code;
            $order->save();



            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity
                ]);
            }


            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => $order->order_id,
                    'gross_amount' => $gross_amount,
                ),
                'customer_details' => array(
                    'first_name' => Auth::user()->first_name,
                    'last_name' => Auth::user()->last_name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone_number ?? '-',
                ),
            );
            DB::commit();

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return view('buyer.pages.payment', compact('snapToken', 'order'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
