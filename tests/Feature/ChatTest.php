<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChatTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Check if chat route works
     * @return void
     */
    public function testChatRouteExists()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testViewCommentOnChat()
    {
        factory(\App\Comment::class, 2)->create(['owner' => 'lemontech']);
        $response = $this->get('/');
        $response->assertSeeText('lemontech');
    }

    public function testCommentsCanBeStored()
    {
        $response = $this->post(route('comment.store'), [
            'owner' => 'Jury',
            'content' => 'Hola mundo!'
        ]);

        $comment = \App\Comment::first();
        $this->assertEquals($comment->owner, 'Jury');
    }

    public function commentsDataProvider()
    {
        return factory(\App\Comment::class, 2)->make(
            ['owner' => 'lemontech']
        );
    }

}
