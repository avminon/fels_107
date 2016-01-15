<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $guarded = [];

    protected $fillable = ['word', 'meaning', 'sound', 'options'];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function lessonWord()
    {
        return $this->hasMany(LessonWord::class, 'word_id');
    }

}
