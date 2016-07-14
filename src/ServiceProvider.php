<?php

namespace JeroenNoten\LaravelPages;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use JeroenNoten\LaravelAdminLte\ServiceProvider as AdminLteServiceProvider;
use JeroenNoten\LaravelPackageHelper\ServiceProviderTraits\Migrations;
use JeroenNoten\LaravelPackageHelper\ServiceProviderTraits\Views;

class ServiceProvider extends BaseServiceProvider
{
    use Migrations, Views;

    public function boot(Routing $routing, Contents $contents)
    {
        $this->publishMigrations();
        $this->loadViews();
        $routing->registerRoutes();
        $contents->registerProvider(new StringProvider);
        $contents->registerProvider(new HtmlProvider);
    }

    public function register()
    {
        $this->app->register(AdminLteServiceProvider::class);
        $this->app->singleton(Contents::class);
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