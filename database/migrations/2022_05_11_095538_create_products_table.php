<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()
            ->references('id')->on('categories')
            ->nullable()
            ->onDelete('set null');
            $table->morphs('product_morph');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('price')->nullable();
            $table->tinyInteger('canPrice')->default(0);
            $table->tinyInteger('hasVariations')->default(0);
            $table->tinyInteger('hasAdditionals')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('products');
    }
}
