<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_employee_r')->unsigned();
            $table->integer('travel_cost_r')->unsigned()->nullable();
            $table->integer('rent_house_r')->unsigned()->nullable();  
            $table->integer('postage_r')->unsigned()->nullable();
            $table->integer('postage_document_r')->unsigned()->nullable(); 
            $table->integer('others_r')->unsigned()->nullable();
            $table->integer('overtime')->unsigned()->nullable();
            $table->integer('benifit')->unsigned()->nullable();
            $table->date('date_finish')->nullable();
            $table->integer('id_project')->unsigned();
            $table->foreign('id_project')->references('id')->on('projects');
            $table->foreign('id_employee_r')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('results', function (Blueprint $table) {
            Schema::dropIfExists('results');
        });
    }
}
