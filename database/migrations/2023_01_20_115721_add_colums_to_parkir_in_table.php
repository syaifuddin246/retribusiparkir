<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsToParkirInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parkir_in', function (Blueprint $table) {
            //
            $table->string('porporasi_kebersihan')->after('porporasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parkir_in', function (Blueprint $table) {
            //
            $table->dropColumn('porporasi_kebersihan');
        });
    }
}
