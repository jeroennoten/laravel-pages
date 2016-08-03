<?php

use Illuminate\Database\Migrations\Migration;
use JeroenNoten\LaravelPages\Models\Content;
use JeroenNoten\LaravelPages\Models\Page;

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