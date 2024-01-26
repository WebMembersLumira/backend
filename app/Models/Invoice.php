<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable =[
        'nomor_rekening',
        'jumlah_transfer',
        'bukti_transfer',
        'status',
        'user_id',
        'langganan_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function langganan()
    {
        return $this->belongsTo(Langganan::class);
    }
}
