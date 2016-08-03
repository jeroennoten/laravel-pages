<?php


namespace JeroenNoten\LaravelPages\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use JeroenNoten\LaravelPages\Contents;
use JeroenNoten\LaravelPages\Page;
use JeroenNoten\LaravelPages\Pages;

class PageController extends Controller
{
    private $pages;

    public function __construct(Pages $pages)
    {
        $this->pages = $pages;
    }

    public function show(Request $request)
    {
        $page = $this->pages->getByUri($request->path());
        return $page->render();
    }
}