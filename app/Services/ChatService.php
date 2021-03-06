<?php
namespace App\Services;

use Illuminate\Cache\Repository as Cache;

class ChatService
{
    private $cache;
    private $cache_key;
    private $cache_expire_time;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
        $this->cache_key = 'chat';
        $this->cache_expire_time = 1000;
    }

    public function getComments()
    {
        $comments = $this->cache->remember($this->cache_key, $this->cache_expire_time, function() {
            return  \App\Comment::with('media')->orderBy('id')->get();
        });
        return $comments;
    }

    public function storeComment($owner, $message)
    {
        $comment = new \App\Comment([
            'owner' => $owner,
            'content' => $message,
            'type' => \App\Comment::TYPE_TEXT
        ]);

        $comment->save();
        $this->cache->forget($this->cache_key);
        return $comment;
    }

    public function storeMedia($owner, $file_path, $file_mime)
    {
        $file_type = guest_filetype($file_mime, \App\Comment::TYPE_MAP);

        $comment = new \App\Comment([
            'owner' => $owner,
            'content' => '',
            'type' => $file_type
        ]);
        $comment->save();
        $comment->media()->create([
            'src' => $file_path
        ]);

        $this->cache->forget($this->cache_key);
        return $comment;
    }
}

