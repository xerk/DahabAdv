<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('clients')
                ->onUpdate('cascade')->onDelete('set null');

            $table->integer('material_id')->unsigned()->nullable();
            $table->foreign('material_id')->references('id')->on('materials')
                ->onUpdate('cascade')->onDelete('set null');

            $table->string('file')->nullable();
            $table->integer('print_type');
            $table->integer('width');
            $table->integer('height');
            $table->integer('amount');
            $table->integer('price_unit');     
            $table->integer('printed');     
            $table->integer('received');     
            $table->integer('total')->nullable();     

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
        Schema::dropIfExists('orders');
    }
}
