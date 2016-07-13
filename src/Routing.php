<?php

namespace JeroenNoten\LaravelPages;

use Illuminate\Contracts\Routing\Registrar;

class Routing
{
    private $router;

    private $pages;

    public function __construct(Registrar $router, Pages $pages)
    {
        $this->router = $router;
        $this->pages = $pages;
    }

    public function registerRoutes()
    {
        $this->router->group([
            'namespace' => __NAMESPACE__ . '\Http\Controllers'
        ], function () {
            $this->registerPageRoutes();
            $this->registerAdminRoutes();
        });
    }

    private function registerPageRoutes()
    {
        foreach ($this->pages->all() as $page) {
            $this->router->get($page->uri, 'PageController@show');
        }
    }

    private function registerAdminRoutes()
    {
        $this->router->group([
            'prefix' => 'admin',
        ], function () {
            $this->router->get('pages', 'PageAdminController@index');
        });
    }
}