<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
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

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($user) {
            $user->activation_token = Str::random(10);
        });
    }

    public function gravatar($size = '100'): string
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "https://www.gravatar.com/avatar/$hash?s=$size";
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function feed()
    {
        return $this->articles()->orderBy('created_at', 'desc');
    }

    // 粉丝
    public function fans(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    // 关注的人
    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    // 关注用户
    public function follow($users_ids): void
    {
        if (!is_array($users_ids)) {
            $users_ids = compact('users_ids');
        }

        $this->followings()->syncWithoutDetaching($users_ids);
    }

    public function unfollow($users_ids): void
    {
        if (!is_array($users_ids)) {
            $users_ids = compact('users_ids');
        }

        $this->followings()->detach($users_ids);
    }

    public function isFollowing($user_id):bool
    {
        return $this->followings->contains($user_id);
    }

}
