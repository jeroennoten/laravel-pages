<?php


use Illuminate\Foundation\Auth\User;
use JeroenNoten\LaravelPages\Models\Page;

class ActivatePageTest extends TestCase
{
    private $activePage;

    private $inactivePage;

    public function setUp() {
        parent::setUp();

        $this->activePage = factory(Page::class)->create(['active' => true, 'uri' => 'active']);
        $this->inactivePage = factory(Page::class)->create(['active' => false, 'uri' => 'inactive']);
    }


    public function testActivateInactivePage()
    {
        $this->actingAs(new User);
        $this->call('PUT', "/admin/pages/api/pages/{$this->inactivePage->id}", [
            'page' => [
                'active' => true,
                'view' => [
                    'contents' => []
                ]
            ]
        ]);

        $this->seeInDatabase('pages', ['active' => true, 'id' => $this->inactivePage->id]);
    }

    public function testDeactivateActivePage()
    {
        $this->actingAs(new User);
        $this->call('PUT', "/admin/pages/api/pages/{$this->activePage->id}", [
            'page' => [
                'active' => false,
                'view' => [
                    'contents' => []
                ]
            ]
        ]);

        $this->seeInDatabase('pages', ['active' => false, 'id' => $this->activePage->id]);
    }

    public function testCannotVisitInactivePage()
    {
        try {
            $this->visit('inactive');
            $this->fail('Can visit incative page');
        } catch (Exception $e) {
        }
    }

    public function testCanVisitActivePage()
    {
        $this->visit('active');
        $this->assertResponseOk();
    }
}