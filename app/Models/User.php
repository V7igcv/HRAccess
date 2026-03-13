<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'password_hash',
        'office_id',
        'role_id',
        'last_login_at'
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the password for the user.
     * This maps password_hash to Laravel's expected password field
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    /**
     * Relationship: User belongs to an Office
     */
    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    /**
     * Relationship: User belongs to a Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Check if user is Super Admin
     */
    public function isSuperAdmin()
    {
        return $this->role && $this->role->name === 'SUPERADMIN';
    }

    /**
     * Check if user is Office Admin
     */
    public function isOfficeAdmin()
    {
        return $this->role && $this->role->name === 'OFFICE ADMIN';
    }

    /**
     * Update last login timestamp
     */
    public function updateLastLogin()
    {
        $this->update(['last_login_at' => now()]);
    }
}