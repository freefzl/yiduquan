<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('degree_id')->index()->default(0)->comment('成色类型id');
            $table->unsignedBigInteger('cate_id')->index()->default(0)->comment('图书类型id');
            $table->unsignedBigInteger('member_id')->index()->default(0)->comment('会员id');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->string('name')->nullable()->comment('书名');
            $table->decimal('pricing')->default(0.00)->comment('定价');
            $table->decimal('price')->default(0.00)->comment('售价');
            $table->integer('inventory')->index()->default(1)->comment('库存');
            $table->integer('attention')->index()->default(0)->comment('关注值');
            $table->string('postage')->nullable()->comment('邮费说明');
            $table->decimal('service')->default(0.00)->comment('服务费');
            $table->string('author')->nullable()->comment('作者');
            $table->string('press')->nullable()->comment('出版社');
            $table->string('image')->comment('图书图片');
            $table->text('other')->nullable()->comment('其他属性');
            $table->tinyInteger('status')->index()->default(0)->comment('图书状态');
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
        Schema::dropIfExists('products');
    }
}
