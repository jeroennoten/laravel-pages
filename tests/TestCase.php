<?php

use JeroenNoten\LaravelPages\ServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    public function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set(
            'database.connections.testbench',
            [
                'driver'   => 'sqlite',
                'database' => ':memory:',
                'prefix'   => '',
            ]
        );

        $app['view']->addLocation(__DIR__.'/stubs/views');
    }

    public function setUp()
    {
        parent::setUp();

        $this->artisan(
            'migrate',
            [
                '--database' => 'testbench',
                '--realpath' => realpath(__DIR__.'/../database/migrations'),
            ]
        );

        $this->withFactories(__DIR__.'/../database/factories');
    }
}