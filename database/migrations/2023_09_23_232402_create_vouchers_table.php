<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->integer('bookingCode')->unique();
            $table->timestamp('bookingDate');
            $table->timestamp('buyDate');
            $table->integer('bookingSeats');
            $table->integer('totalPrice');
            $table->foreignid('triplId')->references('id')->on('trips');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
