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
            $table->integer('status')->length(10)->nullable();
            $table->integer('prod_id')->length(10)->nullable();
            $table->string('user_id')->length(10)->nullable();
            $table->string('drop_address')->length(10)->nullable();
            $table->integer('quantity')->length(10)->nullable();
            $table->decimal('price', 18, 2)->nullable();
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
