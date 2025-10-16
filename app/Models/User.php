<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function issues()
    {
        return $this->belongsToMany(Issue::class, 'issue_user', 'user_id', 'issue_id')
        ->withPivot('role');
    }

    public function reporters()
    {
        return $this->issues()->wherePivot('role', 'reporter');
    }

    public function assignees()
    {
        return $this->issues()->wherePivot('role', 'assignee');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
