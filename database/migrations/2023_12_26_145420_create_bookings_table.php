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
            $table->date('party_day', 0);
            $table->foreignId('schedule_id')->constrained(
                table: 'buffet_schedules', indexName: 'bookings_schedule_id'
            );
            $table->enum('status', array_column(BookingStatus::cases(), 'name'));
            $table->foreignId('buffet_id')->constrained(
                table: 'buffets', indexName: 'booking_buffet_id'
            );
            $table->float('price'); 
            $table->float('discount');
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
