<?php


class ServiceProviderTest extends TestCase
{
    public function testDefaultConfig()
    {
        $config = config('pages');
        $this->assertEquals(['layouts.app'], $config['masters']);
    }
}