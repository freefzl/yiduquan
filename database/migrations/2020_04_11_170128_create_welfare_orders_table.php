<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWelfareOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('welfare_orders', function (Blueprint $table) {
            $table->id();
            $table->string('no')->unique()->comment('订单号');
            $table->unsignedBigInteger('mid')->index()->default(0)->comment('会员id');
            $table->unsignedBigInteger('wid')->index()->default(0)->comment('福利商品id');
            $table->unsignedBigInteger('type')->index()->default(0)->comment('福利商品类型');
            $table->unsignedInteger('number')->index()->default(1)->comment('兑换件数');
            $table->decimal('total')->index()->default(0.00)->comment('订单合计易读点');
            $table->decimal('cash')->index()->default(0.00)->comment('订单合计现金');
            $table->text('address')->comment('收货地址');
            $table->timestamp('paid_at')->nullable()->comment('支付时间');
            $table->tinyInteger('payment_method')->index()->default(1)->comment('支付方式 1：会员支付, 2贵宾支付');
            $table->string('payment_no')->nullable()->comment('支付平台订单号');
            $table->tinyInteger('refund_status')->index()->default(0)->comment('退款状态');
            $table->string('refund_no')->unique()->nullable()->comment('退款订单号');
            $table->tinyInteger('closed')->index()->default(0)->comment('是否关闭订单');
            $table->tinyInteger('ship_status')->index()->default(1)->comment('物流状态');
            $table->text('ship_data')->nullable()->comment('物流数据');
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
        Schema::dropIfExists('welfare_orders');
    }
}
