<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id')->unsigned();
			$table->integer('material_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('file')->nullable();
			$table->tinyInteger('print_type')->nullable();
			$table->integer('width');
			$table->integer('height');
			$table->smallInteger('amount');
			$table->tinyInteger('price_unit');
			$table->tinyInteger('printed');
			$table->tinyInteger('received');
			$table->integer('total')->nullable();
			$table->string('name_file')->nullable();

			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}