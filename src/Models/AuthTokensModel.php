<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthTokensModel extends Model
{
    protected $table = 'auth_tokens';

    protected $fillable = [
        'user_id',
        'token_hash',
        'type',
        'expires_at',
        'used_at'
    ];
}