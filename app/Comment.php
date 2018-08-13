<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const TYPE_TEXT = 0;
    const TYPE_MEDIA = 1;
    protected $fillable = ['owner', 'content', 'type'];
}
