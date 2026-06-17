<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
        'alamat',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ─── CEK ROLE ───
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    // ─── RELASI ───
    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }

    // ─── ACCESSOR ───
    public function getAvatarAttribute(): string
    {
        $initial = strtoupper(substr($this->nama, 0, 1));
        return $initial;
    }

    public function getRoleBadgeAttribute(): string
    {
        if ($this->role === 'admin') {
            return '<span class="px-2.5 py-1 rounded-lg text-xs font-medium bg-purple-50 text-purple-600">Admin</span>';
        }
        return '<span class="px-2.5 py-1 rounded-lg text-xs font-medium bg-sky-50 text-sky-600">User</span>';
    }
}