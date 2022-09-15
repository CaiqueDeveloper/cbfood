<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('user_id')->unsigned()
            ->references('id')->on('users')
            ->nullable()
            ->onDelete('set null');

            $table->integer('product_id')->unsigned()
            ->references('id')->on('products')
            ->nullable()
            ->onDelete('set null');

            $table->string('typePromotion')->nullable();
            $table->string('typeDecount')->nullable();
            $table->string('descount')->nullable();
            $table->date('periodStart');
            $table->date('periodEnd');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('promotions');
    }
}
