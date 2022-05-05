<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments("SURVEY_ID");
            $table->text("SURVEY_NAME");
            $table->text("TERM");
            $table->text("ERA");
            $table->text("SEX");
            $table->text("SPORT");
            $table->dateTime("REGISTER_DATE");
            $table->integer("REGISTER_USER_ID");
            $table->dateTime("UPDATE_DATE");
            $table->integer("UPDATE_USER_ID");
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
        Schema::dropIfExists('surveys');
    }
}
