<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|unique:coupons,code',
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
        ];
    }
}
