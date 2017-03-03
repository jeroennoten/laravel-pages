<?php

namespace JeroenNoten\LaravelPages;

use Illuminate\Config\Repository;
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

        /** @var ContentProviders $contentProviders */
        $contentProviders = $this->getContainer()->make(ContentProviders::class);
        $contentProviders->register(new StringProvider);
        $contentProviders->register(new HtmlProvider);
        $contentProviders->register(new ViewProvider);

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
        $this->app->singleton(ContentProviders::class, function () {
            /** @var array $views */
            $views = config('pages.views');
            return new ContentProviders($this->getCustomTypes($views));
        });
    }

    protected function path(): string
    {
        return __DIR__.'/..';
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

    private function getCustomTypes(array $views)
    {
        $customTypes = [];

        foreach ($views as $view) {
            foreach ($view['sections'] as $section) {
                foreach ($section['contents']['types'] as $id => $config) {
                    if (is_array($config)) {
                        if (isset($config['type'])) {
                            $customTypes[$id] = $config['type'];
                        }
                    }
                }
            }
        }

        return $customTypes;
    }
}