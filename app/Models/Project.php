<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['image_name'];

    protected $casts = [
        'image_name' => 'array',
    ];

    protected static function booted(): void
    {
        self::deleted(function (Project $project) {
            Storage::disk('public')->delete($project->image_name);
        });
    }
}
