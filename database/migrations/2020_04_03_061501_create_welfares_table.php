<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWelfaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('welfares', function (Blueprint $table) {
            $table->id();
            $table->text('image')->comment('商品图片');
            $table->text('content')->comment('商品详情');
            $table->unsignedBigInteger('type_id')->index()->default(0)->comment('商品类型');
            $table->string('name')->comment('商品名称');
            $table->integer('inventory')->index()->default(0)->comment('库存');
            $table->string('postage')->comment('邮费说明');
            $table->decimal('price')->index()->default(0.00)->comment('兑换价');
            $table->decimal('cash')->index()->default(0.00)->comment('现金');
            $table->text('process')->comment('兑换流程');
            $table->text('attention')->comment('注意事项');
            $table->tinyInteger('status')->index()->default(1)->comment('商品状态');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('welfares');
    }
}
