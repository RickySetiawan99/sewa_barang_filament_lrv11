<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'trx_id',
        'proof',
        'phone_number',
        'address',
        'total_amount',
        'product_id',
        'store_id',
        'duration',
        'is_paid',
        'delivery_type',
        'started_at',
        'ended_at',
    ];

    protected $cast = [
        'total_amount' => MoneyCast::class,
        'started_at' => 'date',
        'ended_at' => 'date',
    ];

    public static function generateUniqueTrxId()
    {
        $prefix = 'TRX';
        $timestamp = now()->format('YmdHis');
        $randomNumber = mt_rand(1000, 9999);
        
        $trxId = $prefix . $timestamp . $randomNumber;
        
        // Pastikan ID transaksi unik
        while (self::where('trx_id', $trxId)->exists()) {
            $randomNumber = mt_rand(1000, 9999);
            $trxId = $prefix . $timestamp . $randomNumber;
        }
        
        return $trxId;
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
