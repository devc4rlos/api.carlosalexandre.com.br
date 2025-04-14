<?php

namespace App\Models;

use Database\Factories\SocialNetworkFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    /** @use HasFactory<SocialNetworkFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'icon',
        'text',
    ];
}
