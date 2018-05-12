<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('travel_cost')->unsigned()->nullable();
            $table->integer('rent_house')->unsigned()->nullable();  
            $table->integer('postage')->unsigned()->nullable();
            $table->integer('postage_document')->unsigned()->nullable(); 
            $table->integer('others')->unsigned()->nullable();
            $table->integer('overtime')->unsigned()->nullable();
            $table->integer('benifit')->unsigned()->nullable();
            $table->integer('days')->unsigned();
            $table->integer('id_project')->unsigned();
            $table->foreign('id_project')->references('id')->on('projects'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            Schema::dropIfExists('plans');
        });
    }
}
