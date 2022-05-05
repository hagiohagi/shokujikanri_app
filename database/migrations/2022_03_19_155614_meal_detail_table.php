<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MealDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_detail',function(Blueprint $table) {
            $table->unsignedInteger('meal_id')->comment('食事記録ID');
            $table->foreign('meal_id')->references('meal_id')->on('meal_record')->OnDelete('cascade');
            $table->increments('meal_sub_id')->comment('食事詳細ID');
            $table->string('food')->comment('食事');
            $table->string('ingredient')->comment('材料');
            $table->string('amount')->comment('量');
            $table->string('order_num')->comment('表示順');
            $table->timestamp('created_at')->comment('登録日時');
            $table->unsignedInteger('create_user_id')->comment('登録ユーザーID');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->unsignedInteger('update_user_id')->nullable()->comment('更新ユーザーID');
        });
    }



    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_detail');
    }
}