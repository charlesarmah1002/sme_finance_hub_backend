<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessesModel extends Model
{
    protected $table = 'businesses';

    protected $fillable = [
        'user_id',
        'business_name',
        'business_type',
        'registration_number',
        'status',
        'created_at',
        'updated_at'
    ];
}
