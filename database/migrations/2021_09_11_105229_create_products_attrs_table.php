<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsAttrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_attrs', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('image');
            $table->integer('mrp');
            $table->integer('price');
            $table->integer('qty');
            $table->integer('size_id');

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
        Schema::dropIfExists('products_attrs');
    }
}
