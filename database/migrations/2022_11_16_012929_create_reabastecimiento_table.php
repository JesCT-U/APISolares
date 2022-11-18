<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reabastecimiento', function (Blueprint $table) {
            $table->bigIncrements('reabastecimiento_id');
            $table->integer('unidades');
            $table->integer('Total');
            $table->dateTime('fecha');
            $table->bigInteger('productos_id')->unsigned();
            $table->bigInteger('proveedor_id')->unsigned();
            $table->integer('estado')->default('1');
            $table->timestamps();
            $table->foreign('productos_id')->references('productos_id')->on('productos')->onDelete('cascade');
            $table->foreign('proveedor_id')->references('proveedor_id')->on('proveedor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reabastecimiento');
    }
};
