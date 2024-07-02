<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';

    protected $guarded = ['id'];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public static function getProductByCartUser($id)
    {
        return self::where('cart_id', Auth::user()->cart->id)->where('product_id', $id)->first();
    }

    public static function getSubtotal(User $user)
    {
        $items = $user->cartItems;

        $total = 0;

        foreach ($items as $item) {
            $total +=  $item->product->price * $item->quantity;
        }
        return $total;
    }

    public static function getCount()
    {
        $count = 0;
        foreach (Auth::user()->cartItems as $item) {
            $count += $item->quantity;
        }
        return $count;
    }
}
