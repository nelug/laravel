<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStiloTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estilo', function($table)
		{
			$table->increments('id')->unique();
			$table->string('tipo');
			$table->integer('ancho');
			$table->integer('alto');
			$table->integer('letra');
			$table->string('codigo');
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
		Schema::drop('estilo');
	}

}
