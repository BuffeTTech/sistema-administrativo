<?php

use App\Enums\DocumentType;
use App\Enums\UserStatus;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('document')->unique();
            $table->enum('document_type', array_column(DocumentType::cases(), 'name'));
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('status', array_column(UserStatus::cases(), 'name'));
            $table->string('password')->nullable();     // como as senhas são geradas após a confirmação do e-mail, ela pode ser nula
            $table->foreignId('phone1')->nullable()->constrained(
                table: 'phones', indexName: 'users_phone1'
            );
            $table->foreignId('phone2')->nullable()->constrained(
                table: 'phones', indexName: 'users_phone2'
            );
            $table->foreignId('address')->nullable()->constrained(
                table: 'addresses', indexName: 'users_address'
            );
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
