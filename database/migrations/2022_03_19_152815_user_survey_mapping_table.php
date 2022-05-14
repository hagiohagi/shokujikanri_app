<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserSurveyMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_survey_mapping',function(Blueprint $table) {
            $table->increments('u_p_map_id')->comment('ユーザー調査マッピングID');
            $table->unsignedBigInteger('user_id')->unique()->comment('ユーザーID');
            $table->foreign('user_id')->references('id')->on('users')->OnDelete('cascade');
            $table->unsignedInteger('survey_id')->unique()->comment('調査ID');
            $table->foreign('survey_id')->references('survey_id')->on('survey_info')->OnDelete('cascade');
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
        
        Schema::dropIfExists('user_survey_mapping');
    }
}
