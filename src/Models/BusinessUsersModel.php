<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessUsersModel extends Model
{
    protected $table = 'business_users';

    protected $fillable = [
        'business_id',
        'user_id',
        'role_id',
        'is_owner',
        'joined_at'
    ];
}