<?php

namespace App\Http\Services;

use App\Models\CartItem;
use Exception;
use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ApplyCouponService
{

    public function __construct()
    {
        Session::forget('discount');
        Session::forget('couponCode');
        Session::forget('grandTotal');
    }

    public function apply(Request $request)
    {

        $coupon = Coupon::where('code', $request->code)->first();

        // if coupon not valid to applied
        if ($coupon == null || $coupon->status == 'inactive' || $this->cekStartDate($coupon) == false || $this->cekExprireDate($coupon) == false) {
            return response()->json([
                'status' => false,
                'message' => 'Kupon Tidak Valid!'
            ]);
        }

        // get discount value
        $subtotal = CartItem::getSubtotal(Auth::user());
        $discount = $coupon->discount($subtotal);
        $grand_total = $subtotal - $discount;

        // set discount to session
        Session::put('discount', $discount);
        Session::put('couponCode', $coupon->code);
        Session::put('grandTotal', $grand_total);

        return response()->json(
            [
                'status' => true,
                'message' => "Kupon Berhasil Ditambahkan",
                'code' => $coupon->code,
                'subtotal' => $subtotal,
                'discount' => $coupon->discount($subtotal),
                'grand_total' => $grand_total
            ]
        );
    }

    public function cekStartDate(Coupon $coupon): bool
    {
        if ($coupon->start_date != null) {
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->start_date);
            if (Carbon::now()->lt($startDate)) {
                return false;
            }
        }
        return true;
    }

    public function cekExprireDate($coupon)
    {
        if ($coupon->expiration_date != '') {
            $expireDate = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->expiration_date);

            if (Carbon::now()->gt($expireDate)) {
                return false;
            }
        }
        return true;
    }
}
