<?php

namespace App\Models;

use Database\Factories\GeneralInfoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralInfo extends Model
{
    /** @use HasFactory<GeneralInfoFactory> */
    use HasFactory;

    protected $casts = [
        'freelance_available' => 'boolean',
        'experience_years' => 'integer',
    ];

    protected $fillable = [
        'name',
        'email',
        'title',
        'bio',
        'location',
        'timezone',
        'experience_years',
        'freelance_available'
    ];
}
