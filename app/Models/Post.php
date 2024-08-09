<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'image_name',
        'message',
        'title'
    ];

    // Accessor untuk format created_at
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d F Y');
    }

    // Accessor untuk format updated_at
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d F Y');
    }

    // Accessor for image_name
    // public function getImageNameAttribute($value)
    // {
    //     return Storage::url($value);
    // }
}
