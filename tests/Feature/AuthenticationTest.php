<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    private $auth;
    public function setUp()
    {
        parent::setUp();
        $this->auth = $this->app->make('Illuminate\Contracts\Auth\Guard');
    }

    /**
     * Test that user login after sending a message to the chat
     * @return void
     */
    public function testUserLoginAfterCommentIsSent()
    {
        $this->post(route('comment.store'), [
            'owner' => 'Jury',
            'content' => 'Hola mundo!'
        ]);

        $authenticated_user = $this->auth->user();

        $this->assertEquals($authenticated_user->name, 'Jury');
    }


    /**
     * Test that user logout when clicking on logout
     * @return void
     */
    public function testUserLogout()
    {
        $authenticated_user = factory(\App\User::class, 1)->make(['name' => 'Jury'])->first();
        $this->auth->login($authenticated_user);

        $userLoggedIn = $this->auth->check();

        $this->post(route('logout'));

        $userLoggedOut = $this->auth->check();

        $this->assertTrue($userLoggedIn);
        $this->assertFalse($userLoggedOut);
    }
}
