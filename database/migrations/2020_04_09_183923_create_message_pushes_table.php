<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagePushesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_pushes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mid')->index()->default(0)->comment('会员id');
            $table->string('title')->comment('推送标题');
            $table->text('content')->comment('推送内容');
            $table->tinyInteger('type')->index()->default(1)->comment('推送类型 1：系统消息 2：短信信息 3：公众号信息');
            $table->tinyInteger('class')->index()->default(1)->comment('推送方式 1：群发 2：指定');
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
        Schema::dropIfExists('message_pushes');
    }
}
