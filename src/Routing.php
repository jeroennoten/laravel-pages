<?php

namespace JeroenNoten\LaravelPages;

use Illuminate\Routing\Router;

class Routing
{
    private $router;

    private $pages;

    public function __construct(Router $router, Pages $pages)
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
            'prefix' => 'admin/pages',
            'as' => 'admin.pages.',
            'middleware' => 'web',
            'namespace' => 'Admin',
        ], function (Router $router) {

            $router->get('/create', 'PageController@create')->name('create');
            $router->get('/', 'PageController@index')->name('index');
            $router->post('/', 'PageController@store')->name('store');
            $router->get('/{page}', 'PageController@edit')->name('edit');
            $router->put('/{page}', 'PageController@update')->name('update');
            $router->delete('/{page}', 'PageController@destroy')->name('destroy');

            $this->router->group([
                'as' => 'api.',
                'prefix' => 'api',
                'namespace' => 'Api'
            ], function (Router $router) {

                $router->get('contents/{content}', 'ContentController@show');
                $router->get('layouts/{view}', 'LayoutController@show');
                $router->put('pages/{page}', 'PageController@update');

            });

        });
    }
}