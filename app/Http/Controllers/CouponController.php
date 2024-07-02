<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCouponRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::OrderBy('updated_at', 'DESC')->get();
        return view('admin.pages.manajemen-kupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.manajemen-kupon.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCouponRequest $request)
    {
        try {
            $new_coupon = Coupon::create($request->validated());
            alert('Berhasil', 'Kupon Telah Ditambahkan', 'success');
            return to_route('coupon.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errors', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::where('id', $id)->first();

        return view('admin.pages.manajemen-kupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $coupon)
    {
        try {
            DB::beginTransaction();

            $find_coupon = Coupon::find($coupon);

            // melakukan validasi request
            $validatedData = $request->validate([
                'code' => [
                    'required',
                    Rule::unique('coupons', 'code')->ignore($find_coupon, 'code')
                ],
                'type' => 'required|in:fixed,percent',
                'value' => 'required|numeric',
                'max_uses_user' => 'required|numeric',
                'max_uses' => 'required|numeric',
                'start_date' => [
                    'required',
                    'date',
                    'date_format:Y-m-d H:i',
                    'after_or_equal:' . Carbon::today()->format('Y-m-d H:i'),
                ],
                'expiration_date' => [
                    'required',
                    'date',
                    'date_format:Y-m-d H:i',
                    'after_or_equal:start_date',
                ],
            ]);

            $find_coupon->update($validatedData);

            DB::commit();
            alert('Berhasil', 'Kupon Berhasil Diperbarui', 'success');
            return to_route('coupon.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        //
    }

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            if ($request->mode == 'false') {
                DB::table('coupons')->where('id', '=', $request->id)->update(['status' => 'inactive']);
            } else {
                DB::table('coupons')->where('id', '=', $request->id)->update(['status' => 'active']);
            }
            DB::commit();
            return response()->json([
                'message' => 'Status Kupon Berhasil Diubah',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }
}
