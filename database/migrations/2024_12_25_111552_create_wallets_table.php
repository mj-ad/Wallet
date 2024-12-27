<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('wallet_type_id')->references('id')->on('wallet_types');
            $table->decimal('balance');
            $table->unique(['user_id', 'wallet_type_id'], 'unique_user_wallet_type');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
