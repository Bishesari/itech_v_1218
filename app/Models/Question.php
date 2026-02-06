<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Question extends Model
{
    public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function designer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'designer_id');
    }

    // یک سوال می‌تواند چند گزینه داشته باشد
    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class);
    }

    // برای سوالات عملی، پاسخ عملی
    public function practicalAnswer(): HasOne
    {
        return $this->hasOne(PracticalAnswer::class);
    }

    // media مربوط به خود سوال
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }
}
