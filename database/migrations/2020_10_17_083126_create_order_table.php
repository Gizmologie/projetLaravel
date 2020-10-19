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

            $table->longText('lines')->nullable();

            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

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
