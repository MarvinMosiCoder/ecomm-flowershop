<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->length(10)->nullable();
            $table->integer('product_id')->length(10)->nullable();
            $table->integer('quantity')->length(10)->nullable();
            $table->decimal('subtotal', 18, 2)->nullable();
            $table->integer('shipping_standard')->length(10)->nullable();
            $table->integer('shipping_discount')->length(10)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_lines');
    }
}
