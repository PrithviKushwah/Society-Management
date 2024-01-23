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
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable()->unique();
            $table->unsignedBigInteger('create_by')->nullable();
            $table->unsignedBigInteger('property_id')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('price')->nullable();
            $table->string('type')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('comment')->nullable();
            $table->foreign('create_by')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};
