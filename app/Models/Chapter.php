<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chapter extends Model
{
    protected $fillable = [
        'standard_id',
        'number',
        'title',
    ];

    public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }
}
