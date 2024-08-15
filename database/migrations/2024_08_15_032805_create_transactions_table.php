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
            $table->id();
            $table->string('name');
            $table->string('trx_id');
            $table->string('phone_number');
            $table->string('proof');
            $table->text('address');
            $table->date('started_at');
            $table->unsignedBigInteger('duration');
            $table->date('ended_at');
            $table->boolean('is_paid');
            $table->enum('delivery_type', ['pickup', 'home_delivery'])->default('pickup');
            $table->unsignedBigInteger('amount');
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
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
