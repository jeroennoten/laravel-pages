<?php

namespace JeroenNoten\LaravelPages;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use JeroenNoten\LaravelAdminLte\ServiceProvider as AdminLteServiceProvider;
use JeroenNoten\LaravelCkEditor\ServiceProvider as CkEditorServiceProvider;
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
    use Migrations, Views, Config, Assets;

    public function boot(Routing $routing)
    {
        $this->publishMigrations();
        $this->loadViews();
        $this->publishConfig();

        $routing->registerRoutes();

        ContentProviders::register(new StringProvider);
        ContentProviders::register(new HtmlProvider);
        ContentProviders::register(new ViewProvider);
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
}