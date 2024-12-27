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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->foreignUuid('from_wallet_id')->nullable()->references('id')->on('wallets');
            $table->foreignUuid('to_wallet_id')->nullable()->references('id')->on('wallets');
            $table->decimal('amount');
            $table->enum('transaction_type', ['transfer', 'deposit', 'withdrwal']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
