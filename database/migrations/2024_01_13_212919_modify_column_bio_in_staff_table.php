<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnBioInStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn('bio');
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('phone');
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn('bio');
        });
    }
}
