<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use JeroenNoten\LaravelPages\Models\View;
use JeroenNoten\LaravelPages\Page;

class RenamePageIdToViewIdOnContentsTable extends Migration {

    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->renameColumn('page_id', 'view_id');
        });
    }
    
    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->renameColumn('view_id', 'page_id');
        });
    }

}