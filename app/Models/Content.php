<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'is_active',
        'content',
        'create_user',
        'update_user',
    ];
}
