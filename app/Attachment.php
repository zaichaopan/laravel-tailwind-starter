<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    /**
    * Don't auto-apply mass assignment protection.
    *
    * @var array
    */
    protected $guarded = [];

    protected $appends = ['url'];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            if (Storage::exists($model->path)) {
                Storage::delete($model->path);
            }
        });
    }

    public function getUrlAttribute(): string
    {
        return Storage::url($this->path);
    }

    public function createFromUploadedFile($file, $storeDir)
    {
        return static::create([
            'extension' => $file->extension(),
            'name' => $file->hashName(),
            'size' => $file->getClientSize(),
            'path' => $file->store($storeDir)
        ]);
    }

    public function move($newDir)
    {
        if (Storage::exists($this->path)) {
            Storage::move($this->path, $newPath = trim($newDir, '/') . '/' . $this->name);
            $this->update(['path' => $newPath]);
        }
    }
}
