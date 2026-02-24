<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'blog_title', 'blog_brief_description', 'blog_description', 'author',
        'blog_image', 'blog_status', 'published_date', 'category_id',
        'meta_title', 'meta_description', 'meta_keywords',
    ];

    protected $casts = [
        'author' => 'array',
        'meta_keywords' => 'array',
        'published_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}