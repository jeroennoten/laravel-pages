<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddActiveColumnToPagesTable extends Migration {

    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->boolean('active')->default(true);
        });
    }
    
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }

}