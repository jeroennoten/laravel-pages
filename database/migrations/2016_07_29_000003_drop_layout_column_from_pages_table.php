<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use JeroenNoten\LaravelPages\Models\View;
use JeroenNoten\LaravelPages\Page;

class DropLayoutColumnFromPagesTable extends Migration {

    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('layout');
        });
    }
    
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('layout')->default('');
        });
    }

}