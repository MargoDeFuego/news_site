<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'shortDesc',
        'desc',
        'date',
        'preview_image',
        'full_image',
    ];

    /**
     * Связь: одна статья имеет много комментариев
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
