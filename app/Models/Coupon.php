<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'code',
        'value',
        'type',
        'status',
        'max_uses_user',
        'max_uses',
        'start_date',
        'expiration_date'
    ];

    // Calculate discount value
    public function discount($total)
    {
        if ($this->type  == 'fixed') {
            return $this->value;
        } elseif ($this->type == 'percent') {
            return $total * ($this->value / 100);
        } else {
            return 0;
        }
    }
}
