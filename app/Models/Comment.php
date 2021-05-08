<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_status',
        'post_id',
        'comment_text',
        'user_name',
        'user_email',
    ];

    protected $attributes = [
        'comment_status' => 'review',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
