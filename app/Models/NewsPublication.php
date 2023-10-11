<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsPublication extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'publish_date',
        'category',
        'short_description',
        'content_type',
        'image_path',
        'content',
        'slug',
        'create_user',
        'update_user',
    ];
}
