<?php

use App\Enums\ScheduleDay;
use App\Enums\ScheduleStatus;
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
        Schema::create('buffet_schedules', function (Blueprint $table) {
            $table->id();
            $table->enum('day', array_column(ScheduleDay::cases(), 'name'));
            // define como unico no controller do sistema de buffet, aqui vamos considerar que ja unico pq vai dar trabalho colocar aqui.
            // o 'time' precisa ser unico quando ja existir um daay e buffet_id iguais aos da requisição. pra colocar isso na migration deve precisar colocar
            // validação no meio do unique, acho que nem é possível
            $table->time('time');
            $table->integer('duration');
            $table->dateTime('blocked_in')->nullable();
            $table->dateTime('blocked_until')->nullable();
            $table->enum('status', array_column(ScheduleStatus::cases(), 'name'));
            $table->foreignId('buffet_id')->constrained(
                table: 'buffets', indexName: 'buffet_schedules_buffet_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buffet_schedules');
    }
};
