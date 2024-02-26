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
        Schema::create('receipt_account_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->text('description')->nullable();
            $table->unique(['locale', 'receipt_account_id']);
            $table->foreignId('receipt_account_id')->references('id')->on('receipt_accounts')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt_account_translations');
    }
};
