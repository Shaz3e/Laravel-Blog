<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'category_id',
        'tag_id',
        'title',
        'url_slug',
        'summary',
        'description',
        'featured_image',
        'is_featured',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'published_at',
        'created_by',
        'updated_by',
        'views',
    ];
}
