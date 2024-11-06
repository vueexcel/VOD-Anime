<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $fillable = [
        'mal_id',
        'slug',
        'title',
        'synopsis',
        'image_url',
        'url',
    ];
}
