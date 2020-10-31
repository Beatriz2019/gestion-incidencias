<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_user', function (Blueprint $table) {
            $table->increments('id');
            
            //project id
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');

            // user id
            $table->integer('user_id')->unsigned();
            $table->foreign('id')->references('id')->on('users');

            //Level id
            $table->integer('level_id')->unsigned();
            $table->foreign('level_id')->references('level_id')->on('levels');

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
        Schema::dropIfExists('project_user');
    }
}
