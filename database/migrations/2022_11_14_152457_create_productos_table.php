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
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('productos_id');
            $table->string('codigo',6);
            $table->string('producto');
            $table->text('descripcion')->nullable();
            $table->decimal('precio',15,2);
            $table->decimal('precio_compra',15,2);
            $table->integer('stock');
            $table->integer('stock_min');
            $table->integer('estado')->default('1');
            $table->bigInteger('categorias_id')->unsigned();
            $table->timestamps();
            $table->foreign('categorias_id')->references('categorias_id')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
