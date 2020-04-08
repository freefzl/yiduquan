<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWelfareTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('welfare_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pid')->default(0)->index()->comment('父级id');
            $table->string('cate_name')->nullable()->comment('分类名称');
            $table->integer('sort')->index()->default(0)->comment('排序');
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
        Schema::dropIfExists('welfare_types');
    }
}
