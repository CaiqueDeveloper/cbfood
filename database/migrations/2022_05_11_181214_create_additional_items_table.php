<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('additional_id')->unsigned()
            ->references('id')->on('additionals')
            ->nullable()
            ->onDelete('set null');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('price')->nullable();
            $table->string('code')->nullable();
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
        Schema::dropIfExists('additional_items');
    }
}
