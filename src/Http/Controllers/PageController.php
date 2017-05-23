<?php

namespace JeroenNoten\LaravelPages\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use JeroenNoten\LaravelPages\Contents;
use JeroenNoten\LaravelPages\Page;
use JeroenNoten\LaravelPages\Pages;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    private $pages;

    public function __construct(Pages $pages)
    {
        $this->pages = $pages;
    }

    public function show($uri = '/')
    {
        if (! $page = $this->pages->getActiveByUri($uri)) {
            throw new NotFoundHttpException;
        }

        return $page->render();
    }
}