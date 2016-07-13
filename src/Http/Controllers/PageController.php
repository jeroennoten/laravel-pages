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

    private $contents;

    public function __construct(Pages $pages, Contents $contents)
    {
        $this->pages = $pages;
        $this->contents = $contents;
    }

    public function show(Request $request)
    {
        $page = $this->pages->getByUri($request->path());
        $data = [
            'layout' => $this->getLayout($page),
            'sections' => $this->getSections($page)
        ];
        return view('pages::page', $data);
    }

    private function getLayout(Page $page)
    {
        return "layouts.$page->layout";
    }

    private function getSections(Page $page)
    {
        return $this->contents->getByPage($page);
    }
}