<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_employee')->unsigned(); 
            $table->date('advance_date');
            $table->integer('travel_cost')->unsigned()->nullable();
            $table->integer('rent_house')->unsigned()->nullable();  
            $table->integer('postage')->unsigned()->nullable();
            $table->integer('postage_document')->unsigned()->nullable(); 
            $table->integer('others')->unsigned()->nullable();
            $table->integer('id_project')->unsigned();
            $table->foreign('id_project')->references('id')->on('projects');
            $table->foreign('id_employee')->references('id')->on('users');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advances', function (Blueprint $table) {
            Schema::dropIfExists('advances');
        });
    }
}
