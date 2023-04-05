<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'storages';

    protected $fillable = [
        'product_id',
        'quantity',
        'description'
    ];
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
