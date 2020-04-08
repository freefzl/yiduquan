<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('mid')->index()->default(0)->comment('会员id');
            $table->foreign('mid')->references('id')->on('members')->onDelete('cascade');
            $table->unsignedBigInteger('wid')->index()->default(0)->comment('商品id');
            $table->tinyInteger('status')->index()->default(0)->comment('状态');
            $table->tinyInteger('type')->index()->default(1)->comment('获取类型');
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
        Schema::dropIfExists('vouchers');
    }
}
