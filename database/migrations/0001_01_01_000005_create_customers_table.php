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
        Schema::create('customers', function (Blueprint $table) {
            $table->integer('id', true)->primaryKey('id');
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->string('register', 14)->nullable()->unique();
            $table->string('document', 12)->nullable()->unique();
            $table->string('whatsapp', 12)->nullable()->unique();
            $table->string('phone', 12)->nullable()->unique();
            $table->string('email', 50)->unique();
            $table->string('where_find', 30)->nullable();

            $table->string('zip', 8);
            $table->string('address', 50);
            $table->string('number', 8);
            $table->string('complement', 30);
            $table->string('district', 35);
            $table->string('city', 30);
            $table->string('state', 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
