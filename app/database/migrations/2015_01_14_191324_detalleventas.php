<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Detalleventas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vetas_detalle', function($table)
		{
			$table->increments('id')->unique();
			$table->integer('venta_id')->unsigned();
			$table->foreign('venta_id')->references('id')->on('ventas');
			$table->integer('producto_id')->unsigned();
			$table->foreign('producto_id')->references('id')->on('productos');
			$table->decimal('cantidad');
			$table->decimal('precio');
			$table->decimal('total');
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
		Schema::drop('vetas_detalle');
	}
}
