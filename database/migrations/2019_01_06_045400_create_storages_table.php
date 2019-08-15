<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoragesTable extends Migration {

	public function up()
	{
		Schema::create('storages', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('supplier_id')->unsigned();
			$table->integer('material_id')->unsigned();
			$table->integer('no_meters')->nullable();
			$table->integer('no_liters')->nullable();
			$table->integer('transportation');
			$table->integer('price');

			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('storages');
	}
}