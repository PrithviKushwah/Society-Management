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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->unsignedBigInteger('created_for')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('remaining_amount')->nullable();
            $table->string('comment')->nullable();
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('created_for')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
