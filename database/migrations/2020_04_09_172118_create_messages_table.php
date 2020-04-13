<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mid')->index()->default(0)->comment('会员id');
            $table->string('title')->comment('消息标题');
            $table->text('content')->comment('消息内容');
            $table->tinyInteger('type')->index()->default(1)->comment('消息类型 1：系统消息 2：短信信息 3：公众号信息');
            $table->tinyInteger('status')->index()->default(1)->comment('消息状态');
            $table->tinyInteger('read')->index()->default(0)->comment('是否阅读');
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
        Schema::dropIfExists('messages');
    }
}
