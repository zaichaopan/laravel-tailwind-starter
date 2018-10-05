<?php

namespace App\Traits;

trait HasUuid
{
    public static function bootHasUuid()
    {
        static::creating(function ($model) {
            $model->uuid = static::generateUuid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public static function generateUuid(): string
    {
        return (string)\Illuminate\Support\Str::uuid();
    }
}
