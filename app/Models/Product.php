<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'description',
        'stock',
        'price',
        'weight',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function getProductByCart($id)
    {
        return self::where('id', $id)->first();
    }
}
