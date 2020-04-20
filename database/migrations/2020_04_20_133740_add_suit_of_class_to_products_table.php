<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSuitOfClassToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedTinyInteger('suit_of_class')->index()->default(1)->comment('图书套型 1：一本，2：一套');
            $table->unsignedInteger('suit_number')->index()->default(1)->comment('该套中有多少册');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('suit_of_class');
            $table->dropColumn('suit_number');
        });
    }
}
