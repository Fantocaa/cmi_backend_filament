<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ImageHome extends Model
{
    use HasFactory;

    protected $fillable = ['image_name'];

    protected $casts = [
        'image_name' => 'array',
    ];

    protected static function booted(): void
    {
        self::deleted(function (ImageHome $project) {
            Storage::disk('public')->delete($project->image_name);
        });
    }
}
