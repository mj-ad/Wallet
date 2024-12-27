<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    /** @use HasFactory<\Database\Factories\WalletFactory> */
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'user_id',
        'wallet_type_id',
        'balance'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function walletType() {
        return $this->belongsTo(WalletType::class);
    }    
}
