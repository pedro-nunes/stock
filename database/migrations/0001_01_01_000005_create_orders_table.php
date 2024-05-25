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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('user_id')->index();
            $table->foreignId('customer_id')->index();

            $table->text('delivery_address');

            $table->text('payment');

            $table->decimal('discount', 12, 2);
            $table->decimal('addition', 12, 2);
            $table->decimal('total_order', 12, 2);

            $table->string('whatsapp', 12)->nullable()->unique();
            $table->string('phone', 12)->nullable()->unique();
            $table->string('email', 50)->unique();
            $table->string('where_find', 30)->nullable();

            $table->string('zip', 8);
            $table->string('address', 50);
            $table->string('number', 8);
            $table->string('complement', 30);
            $table->string('district', 35);

            $table->string('information');
            $table->string('observation');
            $table->timestamps();
        });

        Schema::create('orders_products', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('product_id')->index();
            $table->integer('order_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
