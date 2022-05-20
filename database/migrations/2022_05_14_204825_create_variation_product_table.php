<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variation_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()
            ->references('id')->on('products')
            ->nullable()
            ->onDelete('cascade');
            $table->string('variationName');
            $table->string('variationType');
            $table->string('variationPrice');
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
        Schema::dropIfExists('variation_product');
    }
}
