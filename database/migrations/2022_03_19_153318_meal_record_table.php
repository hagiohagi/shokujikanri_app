<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MealRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_record',function(Blueprint $table) {
            $table->Increments('meal_id')->comment('食事記録ID');
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->foreign('user_id')->references('id')->on('users')->OnDelete('cascade');
            $table->integer('meal_type')->comment('食事区分'); // 1:朝食、2:昼食、3:間食、4:夕食、5:夜食
            $table->string('eat_place')->comment('場所');
            $table->date('eat_date')->comment('食事日付');
            $table->time('eat_time')->comment('食事時間');
            $table->string('memo')->nullable()->comment('補足');
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
        Schema::dropIfExists('meal_record');
    }
}
