<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $attributes = [
        'category_status' => 'active',
    ];

    protected $fillable = [
        'category_name',
        'category_status',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
