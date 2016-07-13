<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uri');
            $table->string('layout');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::drop('pages');
    }

}