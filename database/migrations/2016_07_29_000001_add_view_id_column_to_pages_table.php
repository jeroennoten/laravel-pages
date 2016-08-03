<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use JeroenNoten\LaravelPages\Models\View;
use JeroenNoten\LaravelPages\Page;

class AddViewIdColumnToPagesTable extends Migration {

    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->integer('view_id')->unsigned()->nullable();
            $table->foreign('view_id')->references('id')->on('views')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign('pages_view_id_foreign');
            $table->dropColumn('view_id');
        });
    }

}