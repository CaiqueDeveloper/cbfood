<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('promotion_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('promotion_id')
            ->references('id')
            ->on('promotions')
            ->onDelete('cascade');


            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_products');
    }
}
