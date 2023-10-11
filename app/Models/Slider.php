<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'url',
        'youtube_url',
        'is_active',
        'is_caption',
        'slider_path',
        'create_user',
        'update_user',
    ];
}
