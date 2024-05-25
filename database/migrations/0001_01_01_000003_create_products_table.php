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
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->char('code', 18)->unique();
            $table->string('name', 50)->unique();
            $table->string('slug')->unique();
            $table->integer('category_id')->index();
            $table->integer('manufacturer_id')->index()->nullable();
            $table->integer('vendor_id')->index()->nullable();
            $table->decimal('sale_price', 12, 2);
            $table->decimal('cost_price', 12, 2);
            $table->integer('min_stock');
            $table->string('stock', 5);
            $table->string('variation', 40)->nullable();
            $table->char('status', 1);
            $table->mediumText('thumbnail')->nullable();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name', 25)->unique();
            $table->string('slug', 30)->unique();
            $table->integer('category_id')->index()->nullable();
            $table->timestamps();
        });

        Schema::create('manufacturers', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name', 15)->unique();
            $table->string('slug', 20)->unique();
            $table->text('banner')->nullable();
            $table->timestamps();
        });

        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('description', 30);
            $table->integer('amount');
            $table->string('type', 25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('manufacturers');
        Schema::dropIfExists('stocks');
    }
};
