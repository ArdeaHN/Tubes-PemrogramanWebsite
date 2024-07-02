<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\CartItemService;
use Illuminate\Support\Facades\Session;
use App\Http\Services\ApplyCouponService;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartItemController extends Controller
{

    public function __construct(protected CartItemService $cartItemService, protected ApplyCouponService $applyCouponService)
    {
    }

    public function index()
    {

        $items = Auth::user()->cartItems;

        return view('buyer.pages.cart-items', compact('items'));
    }

    public function store(Request $request)
    {
        try {
            Session::forget('discount');
            Session::forget('couponCode');
            Session::forget('grandTotal');
            $this->cartItemService->addToCart($request);

            $response['status'] = true;
            $response['product_id'] = $request->product_id;
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Auth::user()->cartItems->count();

            if ($request->ajax()) {
                $header = view('layouts.partials.navbar')->render();
                $response['header'] = $header;
            }

            return response()->json($response);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroyCart(Request $request)
    {

        try {

            Session::forget('discount');
            Session::forget('couponCode');
            Session::forget('grandTotal');
            $this->cartItemService->execDeleteItem($request);

            $response['status'] = true;
            $response['message'] = "Produk Behasil Dihapus!";
            $response['total'] = CartItem::getSubtotal(Auth::user());
            $response['cart_count'] = $this->cartItemService->getCount();


            if ($request->ajax()) {
                $header = view('layouts.partials.navbar')->render();
                $response['header'] = $header;
            }

            return response()->json($response);
        } catch (\Exception $ex) {
            return json_encode($ex->getMessage());
        }
    }


    public function updateQuantity(Request $request, $item)
    {
        try {
            DB::beginTransaction();
            $item = CartItem::where('id', $item)->firstOrFail();

            if ($request->operation == 'decrement') {
                $this->cartItemService->decrementQuantity($item);
            } elseif ($request->operation == 'increment') {
                $this->cartItemService->incrementQuantity($item);
            }

            return response()->json([
                'success' => true,
                'quantity' => $item->quantity,
                'total' => $item->quantity * $item->product->price,
                'subtotal' => CartItem::getSubtotal(Auth::user())
            ]);
            DB::commit();

            return response();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }

    /**
     * 
     * apply coupon on cart
     * 
     */
    public function applyCoupon(Request $request)
    {
        try {
            return $this->applyCouponService->apply($request);
        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }




    public function checkout($item)
    {
        try {
            $item = CartItem::find($item);
            $order = new Order();
            $order->order_id = (string) Str::uuid();
            $order->product_id = $item->product_id;
            $order->user_id = Auth::user()->id;
            $order->quantity = $item->quantity;
            $order->gross_amount = $item->quantity * $item->product->price;


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
                    'id' => $item->product->id,
                    'price' => $item->product->price,
                    'quantity' => $order->quantity,
                    'name' => $item->product->name
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

            $item->delete();

            return view('buyer.pages.payment', compact('snapToken', 'order'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function showOrder()
    {
        $orders = Order::where('user_id', '=', Auth::user()->id)->get();

        return view('buyer.pages.order', compact('orders'));
    }
}
