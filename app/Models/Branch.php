<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Branch extends Model
{
    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'institute_user')
            ->wherePivotNotNull('branch_id');
    }
}
