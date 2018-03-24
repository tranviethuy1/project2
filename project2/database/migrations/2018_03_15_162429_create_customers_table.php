<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imformations', function (Blueprint $table) {
            $table->increments('id_employee');
            $table->integer('male')->default(1);
            $table->date('birth');
            $table->string('address');
            $table->string('phone',12);
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
        Schema::dropIfExists('imformations');
    }
}
