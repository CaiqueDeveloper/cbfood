<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orders_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
            $table->integer('products_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->text('additional_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->text('price')->nullable();
            $table->text('sizeText')->nullable();
            $table->string('observation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
