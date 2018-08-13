<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChatUserProviderTest extends TestCase
{
    private $chatUserProvider;

    public function setUp()
    {
        parent::setUp();
        $this->chatUserProvider = $this->app->make('\App\Auth\ChatUserProvider');
    }

    /**
     * Test validateCredentials chatUserProvider Method
     * @return void
     */
    public function testValidateCredentials()
    {
        $user = factory(\App\User::class, 1)->make(['name' => 'Jury'])->first();
        $result = $this->chatUserProvider->validateCredentials($user, ['name' => 'Jury']);

        $this->assertTrue($result);
    }

    /**
     * Test chatUserProvider RetrieveByCredetials Method
     * @return void
     */
    public function testRetrieveByCredentials()
    {
        $user = $this->chatUserProvider->retrieveByCredentials(['name' => 'Jury']);

        $this->assertEquals($user->name, 'Jury');
    }

    /**
     * Test RetrieveById, Id is set to name column, so, this test the same as
     * retrieve by credentials
     * @return void
     */
    public function testRetrieveById()
    {
        $user = $this->chatUserProvider->retrieveById('Jury');

        $this->assertEquals($user->name, 'Jury');
    }

}
