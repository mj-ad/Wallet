<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalletType extends Model
{
    /** @use HasFactory<\Database\Factories\WalletTypeFactory> */
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'name',
        'minimum_balance',
        'monthly_interest_rate'
    ];

    public function wallets() {
        return $this->hasMany(Wallet::class);
    }    
}
