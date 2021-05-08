<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $attributes = [
        'tag_status' => 'active',
    ];

    protected $fillable = [
        'tag_name',
        'tag_status',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
