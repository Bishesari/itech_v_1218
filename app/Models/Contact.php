<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contact extends Model
{
    protected $fillable = ['value', 'type', 'is_verified', 'is_active'];
    protected $casts = [
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function users(): BelongsToMany
    {

        return $this->belongsToMany(User::class, 'contact_user', 'contact_id', 'user_id')
            ->using(ContactUser::class)
            ->withPivot('is_primary')
            ->withTimestamps();
    }
}
