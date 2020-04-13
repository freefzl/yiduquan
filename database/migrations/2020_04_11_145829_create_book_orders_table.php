<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_orders', function (Blueprint $table) {
            $table->id();
            $table->string('no')->unique()->comment('订单号');
            $table->unsignedBigInteger('buy_id')->index()->default(0)->comment('买书人');
            $table->unsignedBigInteger('sell_id')->index()->default(0)->comment('卖书人');
            $table->unsignedBigInteger('pid')->index()->default(0)->comment('商品id');
            $table->text('remark')->nullable()->comment('买家留言');
            $table->unsignedInteger('number')->index()->default(1)->comment('购买件数');
            $table->decimal('total')->index()->default(0.00)->comment('订单合计');
            $table->decimal('service_fee')->index()->default(0.00)->comment('服务费');
            $table->text('address')->comment('收货地址');
            $table->timestamp('paid_at')->nullable()->comment('支付时间');
            $table->tinyInteger('payment_method')->index()->default(1)->comment('支付方式 1：会员易读点, 2贵宾易读点');
            $table->string('payment_no')->nullable()->comment('服务费支付平台订单号');
            $table->tinyInteger('refund_status')->index()->default(0)->comment('退款状态');
            $table->string('refund_no')->unique()->nullable()->comment('退款订单号');
            $table->tinyInteger('closed')->index()->default(0)->comment('是否关闭订单');
            $table->tinyInteger('mail_method')->index()->default(1)->comment('邮寄方式 1:自提 2:快递');
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
        Schema::dropIfExists('book_orders');
    }
}
