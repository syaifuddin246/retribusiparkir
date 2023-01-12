<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkirTembiringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkir_tembiring', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('kategori_item_id')->nullable();
            $table->string('plat',225)->nullable();
            $table->string('price',225)->nullable();
            $table->string('status',225)->nullable();
            $table->text('rombongan')->nullable();
            $table->string('porporasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parkir_tembiring');
    }
}
