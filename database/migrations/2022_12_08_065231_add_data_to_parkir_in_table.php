<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToParkirInTable extends Migration
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
            $table->text('rombongan')->after('status')->nullable();
            $table->string('porporasi')->after('status')->nullable();
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
            $table->dropColumn('rombongan');
            $table->dropColumn('porporasi');
        });
    }
}
