<?php

use JeroenNoten\LaravelPages\Models\Page;

class RootRouteTest extends TestCase
{
    public function testRootRoute()
    {
        factory(Page::class)->create(['uri' => '/']);
        $this->visit('/');
        $this->assertResponseOk();
    }
}