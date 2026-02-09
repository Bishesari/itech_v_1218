<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'identifier_type',
        'n_code',
        'gender',
        'f_name_fa',
        'l_name_fa',
        'nickname',
        'f_name_en',
        'l_name_en',
        'father',
        'sh_sh',
        'born_place',
        'born_date',
        'din',
        'mazhab',
        'nezam_id',
        'taahol',
        'child_qty',
        'maghta_id',
        'reshte',
        'address',
        'postal_code',
        'image_url',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
