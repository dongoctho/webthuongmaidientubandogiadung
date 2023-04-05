<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'carts_detail';

    protected $fillable = [
        'cart_id',
        'price',
        'quantity',
        'image',
        'product_id'
    ];
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
