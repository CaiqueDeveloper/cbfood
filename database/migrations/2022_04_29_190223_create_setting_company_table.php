<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_company', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()
            ->references('id')->on('companies')
            ->nullable()
            ->onDelete('set null');
            $table->string('slug_url');
            $table->string('primaryColor')->nullable();
            $table->string('secondColor')->nullable();
            $table->string('deliveryPrice')->nullable();
            $table->string('hasOpeneed')->nullable()->default(1);
            $table->string('hasDelivery')->nullable()->default(1);
            $table->string('limit_send_delivery')->nullable();
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
        Schema::dropIfExists('setting_company');
    }
}
