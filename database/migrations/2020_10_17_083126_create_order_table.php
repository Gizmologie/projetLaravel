<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('delivery_name')->nullable();
            $table->string('delivery_city')->nullable();
            $table->string('delivery_zipCode')->nullable();
            $table->string('delivery_address')->nullable();

            $table->string('delivery_type')->nullable();
            $table->string('delivery_price')->nullable();

            $table->string('state');

            $table->float('price');

            $table->unsignedBigInteger('cart_id')->nullable();

            $table->foreign('cart_id')
                ->references('id')
                ->on('carts')
                ->onDelete('SET NULL');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
