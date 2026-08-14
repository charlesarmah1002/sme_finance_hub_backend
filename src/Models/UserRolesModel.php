<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRolesModel extends Model
{
    protected $table = 'user_roles';

    protected $fillable = [
        'name',
        'description'
    ];
}