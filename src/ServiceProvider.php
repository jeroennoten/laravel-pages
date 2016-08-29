<?php

namespace JeroenNoten\LaravelPages;

use Illuminate\Contracts\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use JeroenNoten\LaravelAdminLte\ServiceProvider as AdminLteServiceProvider;
use JeroenNoten\LaravelCkEditor\ServiceProvider as CkEditorServiceProvider;
use JeroenNoten\LaravelMenu\Pages\Registrar;
use JeroenNoten\LaravelPackageHelper\ServiceProviderTraits;
use JeroenNoten\LaravelPackageHelper\ServiceProviderTraits\Assets;
use JeroenNoten\LaravelPackageHelper\ServiceProviderTraits\Config;
use JeroenNoten\LaravelPackageHelper\ServiceProviderTraits\Migrations;
use JeroenNoten\LaravelPackageHelper\ServiceProviderTraits\Views;
use JeroenNoten\LaravelPages\ContentProviders\ContentProviders;
use JeroenNoten\LaravelPages\ContentProviders\HtmlProvider;
use JeroenNoten\LaravelPages\ContentProviders\StringProvider;
use JeroenNoten\LaravelPages\ContentProviders\ViewProvider;


class ServiceProvider extends BaseServiceProvider
{
    use ServiceProviderTraits;

    public function boot(Routing $routing, Dispatcher $events)
    {
        $this->publishMigrations();
        $this->loadViews();
        $this->publishConfig();
        $this->publishPublicAssets();

        $routing->registerRoutes();

        ContentProviders::register(new StringProvider);
        ContentProviders::register(new HtmlProvider);
        ContentProviders::register(new ViewProvider);

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add([
                'text' => 'Pagina\'s',
                'url' => 'admin/pages'
            ]);
        });

        $this->registerPagesForMenu();
    }

    public function register()
    {
        $this->app->register(AdminLteServiceProvider::class);
        $this->app->register(CkEditorServiceProvider::class);
        $this->app->singleton(Pages::class);
    }

    protected function path(): string
    {
        return __DIR__ . '/..';
    }

    protected function name(): string
    {
        return 'pages';
    }

    private function registerPagesForMenu()
    {
        if (class_exists('JeroenNoten\\LaravelMenu\\Pages\\Registrar')) {
            Registrar::register(app(MenuPagesProvider::class));
        }
    }

    /**
     * Return the container instance
     *
     * @return Container
     */
    protected function getContainer()
    {
        return $this->app;
    }
}