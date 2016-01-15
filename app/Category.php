<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Authenticatable, CanResetPassword;

    protected $guarded = [];

    protected $fillable = ['name', 'image', 'description'];

    public function lesson()
    {
        return $this->hasMany(Lesson::class);
    }

    public function word()
    {
        return $this->hasMany(Word::class, 'category_id');
    }

}
