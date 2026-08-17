<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessesModel extends Model
{
    protected $table = 'business';

    protected $fillable = [
        'name',
        'logo',
        'phone',
        'email',
        'address',
        'country',
        'currency',
        'fiscal_year_start',
        'status'
    ];
}