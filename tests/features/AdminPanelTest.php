<?php

use Illuminate\Auth\GenericUser;

class Admin extends TestCase
{
    public function testCanShowAdminPanel()
    {
        $this->actingAs(new GenericUser([]));

        $this->visit('admin/pages');
        $this->assertResponseOk();
    }
}