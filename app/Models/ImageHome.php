<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageHome extends Model
{
    use HasFactory;

    protected $fillable = ['image_name'];

    protected $casts = [
        'image_name' => 'array',
    ];
}
