<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use JeroenNoten\LaravelPages\Content;
use JeroenNoten\LaravelPages\Models\View;
use JeroenNoten\LaravelPages\Page;

class ChangePageIdsToViewIdsOnContentsTable extends Migration
{
    public function up()
    {
        /** @var Content $content */
        foreach (Content::all() as $content) {
            $page = Page::find($content->viewId);
            $content->view()->associate($page->view);
            $content->save();
        }
    }

    public function down()
    {
        /** @var Content $content */
        foreach (Content::all() as $content) {
            $content->view()->associate($content->view->page);
            $content->save();
        }
    }
}