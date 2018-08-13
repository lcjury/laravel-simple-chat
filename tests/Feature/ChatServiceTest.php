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
     * test comments storage
     * @return void
     **/
    public function testCommentStorage()
    {
        $this->chatService->storeComment('Jury', 'primer comentario!');
        $comments = $this->chatService->getComments();

        $this->assertCount(1, $comments);
        $this->assertEquals($comments->first()->owner, 'Jury');
    }

    /**
     * test if when storing media a comment and a media is created
     * @return void
     **/
    public function testMediaStorage()
    {
        $this->chatService->storeMedia('Jury', '/path/to/file.jpg', 'image/jpg');
        $comments = $this->chatService->getComments();

        $this->assertCount(1, $comments);
        $this->assertEquals($comments->first()->owner, 'Jury');
        $this->assertEquals($comments->first()->media->src, '/path/to/file.jpg');
    }

    /**
     * test if the comment type of a video type is correctly assigned
     * @return void
     **/
    public function testCommentTypeOfVideoComments()
    {
        $this->chatService->storeMedia('Jury', '/path/to/file.mp4', 'video/mp4');
        $comments = $this->chatService->getComments();

        $this->assertCount(1, $comments);
        $this->assertEquals($comments->first()->type, \App\Comment::TYPE_VIDEO);
    }

}
