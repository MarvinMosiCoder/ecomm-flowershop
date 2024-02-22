<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number')->length(255)->nullable();
            $table->string('tracking_number')->length(255)->nullable();
            $table->integer('status')->length(10)->nullable();
            $table->string('user_id')->length(255)->nullable();
            $table->string('drop_address')->length(255)->nullable();
            $table->integer('payment_method')->length(10)->nullable();
            $table->decimal('subtotal', 18, 2)->nullable();
            $table->decimal('shipping', 18, 2)->nullable();
            $table->decimal('shipping_discounts', 18, 2)->nullable();
            $table->decimal('overall_total', 18, 2)->nullable();
            $table->date('order_date')->nullable();
            $table->date('payment_time')->nullable();
            $table->date('shipment_date')->nullable();
            $table->date('delivery_date')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
