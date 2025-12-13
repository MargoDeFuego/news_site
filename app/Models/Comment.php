<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id',
        'content',
        'is_approved',
    ];

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Связь со статьёй
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function scopeApproved($query)
{
    return $query->where('is_approved', true);
}

public function scopePending($query)
{
    return $query->where('is_approved', false);
}

}
