<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders_detail';

    protected $fillable = [
        'order_id',
        'price',
        'quantity',
        'image',
        'product_id'
    ];
    
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
