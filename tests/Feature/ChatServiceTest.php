<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Services\ChatService;

class ChatServiceTest extends TestCase
{
    use DatabaseMigrations;
    private $chatService;

    public function setUp()
    {
        parent::setUp();
        $this->chatService = $this->app->make(ChatService::class);
    }

    public function testCommentsAreRetrievedFromDatabase()
    {
        factory(\App\Comment::class, 1)->create(['owner' => 'Jury']);
        $comments = $this->chatService->getComments();

        $this->assertCount(1, $comments);
        $this->assertEquals($comments->first()->owner, 'Jury');
    }

    /**
     * A basic test example.
     * @return void
     **/
    public function testCommentStorage()
    {
        $this->chatService->storeComment('Jury', 'primer comentario!');
        $comments = $this->chatService->getComments();

        $this->assertCount(1, $comments);
        $this->assertEquals($comments->first()->owner, 'Jury');
    }
}
