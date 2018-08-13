<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const TYPE_TEXT = 0;
    const TYPE_MEDIA = 1;
    const TYPE_VIDEO = 2;

    const TYPE_MAP = [
        'text' => self::TYPE_TEXT,
        'image' => self::TYPE_MEDIA,
        'video' => self::TYPE_VIDEO,
    ];

    protected $fillable = ['owner', 'content', 'type'];

    public function media() {
        return $this->hasOne('App\Media');
    }
}
