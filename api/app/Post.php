<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;

    protected $fillable = ['name', 'content'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get post's user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get all the post's comments
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
