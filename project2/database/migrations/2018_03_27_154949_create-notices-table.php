<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id_notice');
            $table->text('title');
            $table->longtext('content');
            $table->date('create_at');
            $table->string('linkdownload')->nullabe();
            $table->integer('id_employee')->unsigned();
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
        Schema::table('notices', function (Blueprint $table) {
            Schema::dropIfExists('notices');
        });
    }
}
