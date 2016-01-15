<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    protected $fillable = ['activity', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function getActivities()
    {
        $activities = Activity::with('lesson')->where('user_id', Auth::getAuthIdentifier())->get();
        return $activities;
    }
}
