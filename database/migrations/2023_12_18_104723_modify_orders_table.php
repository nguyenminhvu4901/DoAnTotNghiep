<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('customer_address');
            $table->enum('payment_method', [1, 2, 3])->default(1)->after('note'); //1: Truc tiep, 2: VNPAY 3:Momo
            $table->unsignedBigInteger('address_order_id')->after('user_id');
            $table->foreign('address_order_id')->references('id')->on('address_order')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_address');
            $table->dropForeign('orders_address_order_id_foreign');
            $table->dropColumn('address_order_id');
            $table->dropColumn('payment_method');
        });
    }
}
