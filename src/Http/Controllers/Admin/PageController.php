<?php


namespace JeroenNoten\LaravelPages\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use JeroenNoten\LaravelPages\Models\Page;
use JeroenNoten\LaravelPages\Models\View;
use JeroenNoten\LaravelPages\Pages;

class PageController extends Controller
{
    private $pages;

    public function __construct(Pages $pages)
    {
        $this->pages = $pages;
    }

    public function index()
    {
        $pages = $this->pages->allWithTitles();
        return view('pages::admin.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        $page->load('view.contents');
        return view('pages::admin.edit', compact('page'));
    }

    public function update(Page $page, Request $request, Redirector $redirect)
    {
        $page->update(['uri' => $request->input('uri')]);
        $page->updateContents($request->input('page')['contents']);
        return $redirect->route('admin.pages.edit', $page);
    }

    public function destroy(Page $page, Redirector $redirect)
    {
        $page->delete();
        return $redirect->route('admin.pages.index');
    }

    public function create()
    {
        return view('pages::admin.create');
    }

    public function store(Request $request, Redirector $redirect)
    {
        $view = View::make();
        $view->save();

        $page = Page::make($request->input('uri'));
        $page->view()->associate($view);
        $page->save();

        return $redirect->route('admin.pages.edit', $page);
    }

}