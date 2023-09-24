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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->integer('bookingCode');
            $table->timestamp('bookingDate');
            $table->timestamp('buyDate');
            $table->integer('bookingSeats');
            $table->integer('totalPrice');
            $table->string('tripOrigin');
            $table->string('tripDestination');


            $table->primary('bookingCode');
            $table->foreign(['tripOrigin', 'tripDestination'])->references(['origin','destination'])->on('trips');
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
