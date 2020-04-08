<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('mid')->index()->default(0)->comment('会员id');
            $table->foreign('mid')->references('id')->on('members')->onDelete('cascade');
            $table->string('name')->comment('姓名');
            $table->string('mobile')->comment('手机号');
            $table->string('province')->comment('省');
            $table->string('city')->comment('市');
            $table->string('area')->comment('区');
            $table->string('address')->comment('详情地址');
            $table->tinyInteger('default')->index()->default(0)->comment('默认收货地址');
            $table->tinyInteger('status')->index()->default(1)->comment('使用状态');
            $table->double('longitude',10,3)->comment('经度');
            $table->double('latitude',10,3)->comment('纬度');
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
        Schema::dropIfExists('addresses');
    }
}
