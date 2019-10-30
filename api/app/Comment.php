<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Get the comments creator (user)
     */
    public function creator()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the comment's parent comment id
     */
    public function parent_id()
    {
        return $this->belongsTo('App\Comment');
    }
}
