<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('material_id')->references('id')->on('materials')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('storages', function(Blueprint $table) {
			$table->foreign('supplier_id')->references('id')->on('suppliers')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('storages', function(Blueprint $table) {
			$table->foreign('material_id')->references('id')->on('materials')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('payments', function(Blueprint $table) {
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_client_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_material_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_user_id_foreign');
		});
		Schema::table('storages', function(Blueprint $table) {
			$table->dropForeign('storages_supplier_id_foreign');
		});
		Schema::table('storages', function(Blueprint $table) {
			$table->dropForeign('storages_material_id_foreign');
		});
		Schema::table('payments', function(Blueprint $table) {
			$table->dropForeign('payments_order_id_foreign');
		});
	}
}