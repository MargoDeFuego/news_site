<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // ← добавлено!

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // ← добавлено HasApiTokens

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

        // связь с Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // удобные проверки
    public function isModerator(): bool
    {
        return $this->role && $this->role->name === 'moderator';
    }

    public function isReader(): bool
    {
        return $this->role && $this->role->name === 'reader';
    }
}
