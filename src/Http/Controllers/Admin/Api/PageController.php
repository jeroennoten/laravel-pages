<?php

namespace JeroenNoten\LaravelPages\Http\Controllers\Admin\Api;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use JeroenNoten\LaravelPages\Models\Page;

class PageController extends Controller {

    public function update(Page $page, Request $request)
    {
        $page->updatePage($request->input('page'));
    }

}