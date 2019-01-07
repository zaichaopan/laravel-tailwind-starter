<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
    * Don't auto-apply mass assignment protection.
    *
    * @var array
    */
    protected $guarded = [];

    protected $appends=['created_at_for_humans'];

    protected $with = ['user', 'comments'];

    public function parent()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function getCreatedAtForHumansAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
