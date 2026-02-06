<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use Notifiable, TwoFactorAuthenticatable;

    protected $fillable = ['user_name', 'password', 'is_active'];

    protected $hidden = ['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class)
            ->withPivot('is_primary')
            ->withTimestamps();
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'institute_user')
            ->withPivot(['institute_id', 'branch_id', 'is_active'])
            ->withTimestamps();
    }

    public function institutes(): BelongsToMany
    {
        return $this->belongsToMany(Institute::class, 'institute_user')
            ->distinct();
    }

    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'institute_user')
            ->distinct();
    }

    public function hasRole(string $role, ?Institute $institute = null, ?Branch $branch = null): bool
    {
        return $this->roles()
            ->where('name_en', $role)
            ->when($institute, fn ($q) => $q->wherePivot('institute_id', $institute->id)
            )
            ->when($branch, fn ($q) => $q->wherePivot('branch_id', $branch->id)
            )
            ->exists();
    }
}
