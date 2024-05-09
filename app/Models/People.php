<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Database\Eloquent\{Builder, Model};

class People extends Model
{
    use HasFactory;

    protected $table = 'people';

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(PeoplePhoto::class);
    }

    public function scopeSearch(Builder $b, ?string $val): Builder
    {
        return $b->where('name', 'like', "%{$val}%")->orWhere('surname', 'like', "%{$val}%");
    }
}
