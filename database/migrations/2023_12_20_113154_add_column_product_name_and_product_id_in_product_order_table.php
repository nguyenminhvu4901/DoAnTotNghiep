<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnProductNameAndProductIdInProductOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_order', function (Blueprint $table) {
            $table->dropForeign('product_order_product_detail_id_foreign');
            $table->dropColumn('product_detail_id');
        });

        Schema::table('product_order', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_order', function (Blueprint $table) {
            $table->unsignedBigInteger('product_detail_id');
            $table->foreign('product_detail_id')->references('id')->on('product_detail')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('product_order', function (Blueprint $table) {
            $table->dropForeign('product_order_product_id_foreign');
            $table->dropColumn('product_id');
        });
    }
}
