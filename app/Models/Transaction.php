<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'from_wallet_id',
        'to_wallet_id',
        'amount',
        'transaction_type'
    ];

    public function fromWallet() {
        return $this->belongsTo(Wallet::class, 'from_wallet_id');
    }
    
    public function toWallet() {
        return $this->belongsTo(Wallet::class, 'to_wallet_id');
    }    
}
