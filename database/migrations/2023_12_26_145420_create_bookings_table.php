<?php

use App\Enums\BookingStatus;
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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name_birthdayperson', 255);
            $table->string('years_birthdayperson', 255);
            $table->integer('num_guests'); 
            $table->integer('num_extra_guests'); 
            $table->date('party_day');
            $table->time('party_start_time');
            $table->integer('party_duration'); 
            $table->foreignId('buffet_id')->constrained(
                table: 'buffets', indexName: 'booking_buffet_id'
            );
            $table->float('price_schedule'); 
            $table->float('price_decoration'); 
            $table->float('price_food'); 
            $table->float('total_price');
            $table->float('discount');
            $table->enum('status', array_column(BookingStatus::cases(), 'name'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
