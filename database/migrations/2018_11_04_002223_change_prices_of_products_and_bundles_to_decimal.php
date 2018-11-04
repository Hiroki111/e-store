<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePricesOfProductsAndBundlesToDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->default(0.00)->change();
        });
        Schema::table('bundles', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->default(0.00)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->double('price', 8, 2)->default(0.00)->change();
        });
        Schema::table('bundles', function (Blueprint $table) {
            $table->double('price', 8, 2)->default(0.00)->change();
        });
    }
}
