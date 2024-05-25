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
        Schema::create('vendors', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 40);
            $table->string('company_name', 65)->unique();
            $table->string('document', 18)->unique();
            $table->string('reg_state', 9)->nullable()->unique();
            $table->string('reg_municipal', 11)->nullable()->unique();
            $table->string('responsible', 20);
            $table->string('phone', 13);
            $table->string('email', 50);
            $table->string('zip', 8);
            $table->string('address', 50);
            $table->string('number', 8);
            $table->string('complement', 30)->nullable();
            $table->string('district', 35);
            $table->string('city', 30);
            $table->string('state', 2);
            $table->text('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
