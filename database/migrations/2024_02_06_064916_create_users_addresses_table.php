<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('fullname')->nullable();
            $table->integer('phone_number')->length(11)->nullable();
            $table->integer('region')->length(11)->nullable();
            $table->integer('province')->length(11)->nullable();
            $table->integer('city')->length(11)->nullable();
            $table->integer('barangay')->length(11)->nullable();
            $table->string('house_no')->nullable();
            $table->integer('postal_code')->nullable()->length(11);
            $table->string('label_as')->nullable();
            $table->integer('is_default')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('users_addresses');
    }
}
