<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'chat_id', 'sender', 'text', 'chat_image_url', 'chat_video_url',
        'chat_document_url', 'seen_by',
    ];

    protected $casts = [
        'sender' => 'array',
        'seen_by' => 'array',
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}