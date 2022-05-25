<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // STATUS
        //1 pedido enviado
        //2 pedido recebido
        //3 pedido enviado a cozinha
        //4 pedido saindo para ser entregue
        //5 pedido entregue
        //0 pedido cancelado cliente/ou estabilecimento 
        
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()
            ->references('id')->on('companies')
            ->nullable()
            ->onDelete('set null');
            $table->integer('user_id')->unsigned()
            ->references('id')->on('users')
            ->nullable()
            ->onDelete('set null');
            $table->integer('address_id')->unsigned()
            ->references('id')->on('address')
            ->nullable()
            ->onDelete('set null');
            $table->string('payment_method');
            $table->string('delivery_price');
            $table->string('price_total');
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
        Schema::dropIfExists('orders');
    }
}
