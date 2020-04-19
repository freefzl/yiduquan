<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->engine = 'InnoDB';
            $table->string('open_id')->comment('微信id');
            $table->string('head')->nullable()->comment('头像');
            $table->string('nickname')->comment('昵称');
            $table->string('password')->nullable()->comment('密码');
            $table->string('mobile', 20)->comment('手机号码');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('name')->comment('姓名');
            $table->string('weixin')->nullable()->comment('微信号');
            $table->string('qq')->nullable()->comment('qq');
            $table->string('city')->nullable()->comment('所在城市');
            $table->decimal('yidudian')->index()->default(0.00)->comment('易读点');
            $table->integer('integral')->index()->default(0)->comment('积分');
            $table->decimal('balance')->index()->default(0.00)->comment('余额');
            $table->decimal('balance')->index()->default(0.00)->comment('余额');
            $table->tinyInteger('level')->index()->default(1)->comment('等级');
            $table->tinyInteger('status')->index()->default(1)->comment('状态');
            $table->integer('referees')->index()->default(0)->comment('推荐人');
            $table->integer('active')->index()->default(30)->comment('活跃度');
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
        Schema::dropIfExists('members');
    }
}
