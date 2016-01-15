<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $guarded = [];

    public function followee()
    {
        return $this->hasMany(User::class, 'followee_id');
    }

    public function follower()
    {
        return $this->hasMany(User::class, 'follower_id');
    }
}
