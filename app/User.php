<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    const ROLE_ADMIN = 'admin';

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password', 'avatar'];

    protected $hidden = ['password', 'remember_token'];

    public function lesson()
    {
        return $this->hasMany(Lesson::class, 'user_id');
    }

    public function activity()
    {
        return $this->hasMany(Activity::class, 'user_id');
    }

    public function follower()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function followee()
    {
        return $this->hasMany(Follow::class, 'followee_id');
    }

    public function isAdmin()
    {
        if ($this->type == User::ROLE_ADMIN)
        {
            return true;
        }
        return false;
    }
}

