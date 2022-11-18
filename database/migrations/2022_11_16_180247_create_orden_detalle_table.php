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
        Schema::create('orden_detalle', function (Blueprint $table) {
            $table->bigIncrements('detalle_id');
            $table->string('codigo');
            $table->integer('unidades');
            $table->decimal('total',15,2);
            $table->bigInteger('productos_id')->unsigned();
            $table->bigInteger('orden_id')->unsigned();
            $table->timestamps();
            $table->foreign('productos_id')->references('productos_id')->on('productos')->onDelete('cascade');
            $table->foreign('orden_id')->references('orden_id')->on('orden')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_detalle');
    }
};
