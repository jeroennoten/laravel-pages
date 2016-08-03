<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use JeroenNoten\LaravelPages\Models\View;
use JeroenNoten\LaravelPages\Page;

class DropForeignPageIdFromContentsTable extends Migration {

    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropForeign('contents_page_id_foreign');
        });
    }
    
    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

}