<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lessonWord()
    {
        return $this->hasMany(LessonWord::class, 'lesson_id');
    }

    public function activity()
    {
        return $this->hasOne(Activity::class, 'lesson_id')
    }
}
