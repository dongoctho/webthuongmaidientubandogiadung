<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'storage_details';

    protected $fillable = [
        'storage_id',
        'price',
        'number',
        'quantity',
    ];
    public function storage(){
        return $this->belongsTo(Storage::class, 'storage_id');
    }
}
