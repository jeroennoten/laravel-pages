<?php

use Illuminate\Database\Eloquent\Collection;
use JeroenNoten\LaravelPages\Pages;

class PagesTest extends TestCase
{
    public function testAllWithoutDatabase()
    {
        $this->artisan('migrate:reset');

        $pages = new Pages;

        $this->assertInstanceOf(Collection::class, $pages->all());
    }
}