<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuppliersTable extends Migration {

	public function up()
	{
		Schema::create('suppliers', function(Blueprint $table) {
			$table->increments('id');
			$table->string('representative');
			$table->string('company')->nullable();
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->string('phone_2')->nullable();
			$table->longText('address')->nullable();
			$table->longText('address_2')->nullable();

			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('suppliers');
	}
}