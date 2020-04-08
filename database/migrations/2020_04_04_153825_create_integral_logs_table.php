<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntegralLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integral_logs', function (Blueprint $table) {
            $table->id();
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('mid')->index()->default(0)->comment('会员id');
            $table->foreign('mid')->references('id')->on('members')->onDelete('cascade');
            $table->string('title')->comment('记录标题');
            $table->decimal('integral')->index()->default(0.00)->comment('积分');
            $table->tinyInteger('status')->index()->default(1)->comment('积分状态');
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
        Schema::dropIfExists('integral_logs');
    }
}
