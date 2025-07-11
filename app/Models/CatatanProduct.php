<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'total_price',
        'product_id',
        'status'
    ];

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}

}
