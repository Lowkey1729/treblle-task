<?php

namespace App\Services\Concerns\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUUID
{
    public static function generateUUID(Model $model): string
    {
        $uuid = Str::uuid();
        if ($model->where('uuid', $uuid)->first()) {
            self::generateUUID($model);
        }

        return $uuid;
    }

    protected static function boot(): void
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = self::generateUUID($model);
        });
    }
}
