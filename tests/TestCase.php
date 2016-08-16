<?php

use JeroenNoten\LaravelPages\ServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    public function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }
}