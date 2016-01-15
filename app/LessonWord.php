<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonWord extends Model
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $guarded = [];

    protected $fillable = ['answer', 'result'];

    public function category()
    {
        return $this->belongsTo(Word::class, 'word_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}
