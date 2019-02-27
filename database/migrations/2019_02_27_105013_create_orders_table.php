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
            $table->string('payment_id')->nullable();
            $table->decimal('total_price', 8, 2)->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email');
            $table->string('delivery_address_1');
            $table->string('delivery_address_2')->nullable();
            $table->string('delivery_suburb');
            $table->string('delivery_state');
            $table->string('delivery_postcode');
            $table->unsignedTinyInteger('use_delivery_address');
            $table->string('billing_address_1');
            $table->string('billing_address_2')->nullable();
            $table->string('billing_suburb');
            $table->string('billing_state');
            $table->string('billing_postcode');
            $table->unsignedTinyInteger('read_policy');
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
