<?php

namespace App\Http\Services;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartItemService
{

    public function __construct()
    {
        Session::forget('discount');
        Session::forget('couponCode');
        Session::forget('grandTotal');
    }
    public function getItems()
    {

        return Auth::user()->cartItems;
    }

    public function getCount()
    {
        $count = 0;
        foreach (Auth::user()->cartItems as $item) {
            $count += $item->quantity;
        }
        return $count;
    }


    public function addToCart(Request $request)
    {

        $cartItem = CartItem::getProductByCartUser($request->product_id);
        if ($cartItem) {
            return $this->incrementQuantity($cartItem);
        } else {
            $item = new CartItem();
            $item->cart_id = Auth::user()->cart->id;
            $item->product_id = $request->product_id;
            $item->quantity = $request->quantity;
            $item->save();
            return $item;
        }
    }

    public function incrementQuantity(CartItem $item)
    {
        return $item->update([
            'quantity' => $item->quantity + 1
        ]);
    }
    public function decrementQuantity(CartItem $item)
    {
        return $item->update([
            'quantity' => $item->quantity - 1
        ]);
    }


    public function execDeleteItem(Request $request)
    {
        return CartItem::getProductByCartUser($request->product_id)->delete();
    }
}
