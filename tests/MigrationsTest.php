<?php

class MigrationsTest extends TestCase
{
    public function testMigrations()
    {
        $this->artisan('migrate:reset');
    }
}