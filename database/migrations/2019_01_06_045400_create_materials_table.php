<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMaterialsTable extends Migration {

	public function up()
	{
		Schema::create('materials', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->longText('body')->nullable();

			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('materials');
	}
}