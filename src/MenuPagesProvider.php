<?php


namespace JeroenNoten\LaravelPages;


use JeroenNoten\LaravelMenu\Pages\Page as MenuPage;
use JeroenNoten\LaravelMenu\Pages\Provider;
use JeroenNoten\LaravelPages\Models\Page;

class MenuPagesProvider implements Provider
{
    private $pages;

    public function __construct(Pages $pages)
    {
        $this->pages = $pages;
    }

    public function getPages()
    {
        return $this->pages->allWithTitles()->map(function (Page $page) {
            return new MenuPage($page->title, $page->uri);
        })->all();
    }
}