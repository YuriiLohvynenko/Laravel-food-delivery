<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user');
            $table->bigInteger('negocio');
            $table->longText('metodo');
            $table->string('zona');
            $table->string('urbanizacion');
            $table->string('calle');
            $table->string('casa');
            $table->string('referencia');
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->float('subtotal');
            $table->float('costodelivery');
            $table->float('total');
            $table->string('moneda');
            $table->float('tasadecambio');
            $table->string('comprobante')->nullable();
            $table->string('comprobante2')->nullable();
            $table->longText('instrucciones')->nullable();
            $table->string('estatus')->default('PENDIENTE');
            $table->integer('votonegocio')->default(0);
            $table->integer('votocliente')->default(0);
            $table->integer('votodelivery')->default(0);
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
        Schema::dropIfExists('pedidos');
    }
}
