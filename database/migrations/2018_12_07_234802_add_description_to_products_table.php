<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('alcohol', 8, 2)->nullable()->after('price');
            $table->text('packaging')->nullable()->after('alcohol');
            $table->text('description')->nullable()->after('packaging');
            $table->integer('limit_per_checkout')->default(0)->after('description');
            $table->integer('discount_qty')->default(0)->after('limit_per_checkout');
            $table->integer('discount_price')->default(0)->after('discount_qty');
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
            $table->dropColumn('alcohol');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('packaging');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('description');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('limit_per_checkout');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('discount_qty');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('discount_price');
        });
    }
}
