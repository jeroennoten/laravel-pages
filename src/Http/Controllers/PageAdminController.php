<?php


namespace JeroenNoten\LaravelPages\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use JeroenNoten\LaravelPages\Pages;

class PageAdminController extends Controller
{
    private $pages;

    public function __construct(Pages $pages)
    {
        $this->pages = $pages;
    }

    public function index()
    {
        return view('pages::admin.index');
    }

}