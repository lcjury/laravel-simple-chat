<?php
namespace App\Services;

class ChatService
{
    public function getComments()
    {
        return  \App\Comment::orderBy('id')->get();
    }

    public function storeComment($owner, $message)
    {
        $comment = new \App\Comment([
            'owner' => $owner,
            'content' => $message,
            'type' => \App\Comment::TYPE_TEXT
        ]);

        $comment->save();
        return $comment;
    }
}

