<?php

use JeroenNoten\LaravelPages\ServiceProvider;
use Laravel\BrowserKitTesting\Concerns\InteractsWithDatabase;
use Laravel\BrowserKitTesting\Concerns\InteractsWithPages;
use Laravel\BrowserKitTesting\Concerns\MakesHttpRequests;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use PHPUnit_Framework_ExpectationFailedException as PHPUnitException;
use Illuminate\Foundation\Testing\HttpException;
use PHPUnit_Framework_Assert as PHPUnit;

class TestCase extends OrchestraTestCase
{
    use InteractsWithDatabase;

    protected $response;

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
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
            ]
        );

        $app['view']->addLocation(__DIR__.'/stubs/views');
    }

    public function setUp()
    {
        parent::setUp();

        $options = [
            '--database' => 'testbench',
        ];

        if (version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<')) {
            $options['--realpath'] = realpath(__DIR__.'/../database/migrations');
        }

        $this->artisan('migrate', $options);

        $this->withFactories(__DIR__.'/../database/factories');
    }


    public function visit($uri)
    {
        return $this->makeRequest('GET', $uri);
    }

    protected function makeRequest($method, $uri, $parameters = [], $cookies = [], $files = [])
    {
        $uri = $this->prepareUrlForRequest($uri);

        $this->call($method, $uri, $parameters, $cookies, $files);

        $this->clearInputs()->followRedirects()->assertPageLoaded($uri);

        $this->currentUri = $this->app->make('request')->fullUrl();

        $this->crawler = new Crawler($this->response->getContent(), $this->currentUri);

        return $this;
    }

    protected function clearInputs()
    {
        $this->inputs = [];

        $this->uploads = [];

        return $this;
    }

    protected function followRedirects()
    {
        while ($this->response->isRedirect()) {
            $this->makeRequest('GET', $this->response->getTargetUrl());
        }

        return $this;
    }

    public function call($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null)
    {
        $kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');

        $this->currentUri = $this->prepareUrlForRequest($uri);

        $this->resetPageContext();

        $symfonyRequest = SymfonyRequest::create(
            $this->currentUri, $method, $parameters,
            $cookies, $this->filterFiles($files), array_replace($this->serverVariables, $server), $content
        );

        $request = Request::createFromBase($symfonyRequest);

        $response = $kernel->handle($request);

        $kernel->terminate($request, $response);

        return $this->response = $response;
    }
    protected function resetPageContext()
    {
        $this->crawler = null;

        $this->subCrawlers = [];
    }

    protected function filterFiles($files)
    {
        foreach ($files as $key => $file) {
            if ($file instanceof UploadedFile) {
                continue;
            }

            if (is_array($file)) {
                if (! isset($file['name'])) {
                    $files[$key] = $this->filterFiles($files[$key]);
                } elseif (isset($files[$key]['error']) && $files[$key]['error'] !== 0) {
                    unset($files[$key]);
                }

                continue;
            }

            unset($files[$key]);
        }

        return $files;
    }
    protected function assertPageLoaded($uri, $message = null)
    {
        $status = $this->response->getStatusCode();

        try {
            $this->assertEquals(200, $status);
        } catch (PHPUnitException $e) {
            $message = $message ?: "A request to [{$uri}] failed. Received status code [{$status}].";

            $responseException = isset($this->response->exception)
                ? $this->response->exception : null;

            throw new HttpException($message, null, $responseException);
        }
    }
    public function assertResponseOk()
    {
        $actual = $this->response->getStatusCode();

        PHPUnit::assertTrue($this->response->isOk(), "Expected status code 200, got {$actual}.");

        return $this;
    }
}