<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storages', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('supplier_id')->unsigned()->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')
                ->onUpdate('cascade')->onDelete('set null');

            $table->integer('material_id')->unsigned()->nullable();
            $table->foreign('material_id')->references('id')->on('materials')
                ->onUpdate('cascade')->onDelete('set null');

            $table->integer('no_meters')->nullable();
            $table->integer('no_liters')->nullable();
            $table->integer('transportation')->nullable();
            $table->integer('price');

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
        Schema::dropIfExists('storages');
    }
}
