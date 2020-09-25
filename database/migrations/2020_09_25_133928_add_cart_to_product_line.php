<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCartToProductLine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_lines', function (Blueprint $table) {
            $table->unsignedBigInteger('cart_id')->nullable();

            $table->foreign('cart_id')
                ->references('id')
                ->on('carts')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_lines', function (Blueprint $table) {
            //
        });
    }
}
