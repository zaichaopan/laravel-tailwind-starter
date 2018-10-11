<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasUuid;

    /**
    * Don't auto-apply mass assignment protection.
    *
    * @var array
    */
    protected $guarded = [];

    protected $with = ['images'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->images->each->delete();
        });
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function imageRootDir()
    {
        return 'places' . '/' . $this->id;
    }
}
