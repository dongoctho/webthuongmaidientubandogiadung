<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'code',
        'name',
        'price',
        'category_id',
        'manufacture_id',
        'description',
        'discount',
        'product_type',
        'sale',
        'image'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function manufacture(){
        return $this->belongsTo(Manufacture::class, 'manufacture_id');
    }

}
