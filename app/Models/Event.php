<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'place',
        'date',
        'description',
        'pic',
        'price',
        'slug',
        'image_path',
        'create_user',
        'update_user',
    ];
}
