<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MealPhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_photo',function(Blueprint $table) {
            $table->increments('photo_num')->comment('写真番号');
            $table->unsignedInteger('meal_id')->comment('食事記録ID');
            $table->foreign('meal_id')->references('meal_id')->on('meal_record')->OnDelete('cascade');
            $table->string('photo_path')->comment('写真パス');
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
        Schema::dropIfExists('meal_photo');
    }
}