<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id')->comment('ユーザーID');
            $table->string('user_name')->comment('名前');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('パスワード');
            $table->rememberToken();
            $table->boolean('sex_type')->comment('性別');
            $table->integer('height')->comment('身長');
            $table->integer('weight')->comment('体重');
            $table->integer('fat_percentage')->nullable()->comment('体脂肪率');
            $table->string('sport_name')->comment('競技名');
            $table->string('sport_position')->nullable()->comment('ポジション');
            $table->integer('auth_type')->default(1)->comment('権限区分'); // 1:回答者,2:研究者,3:管理者            
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
        Schema::dropIfExists('users');
    }
}
