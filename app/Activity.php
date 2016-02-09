<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    const NO_ACTIVITY = 0;
    const FOLLOW_ACTIVITY = 2;
    const LESSON_ACTIVITY = 1;
    const NO_LESSONID = 0;
    const WITH_LESSONID = 1;

    protected $guarded = [];

    protected $fillable = ['lesson_id', 'user_id', 'activity', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function getAllUserActivities($userId)
    {
        return Activity::where('user_id', $userId)->get();
    }

    public function getUserFolloweeActivities($userId)
    {
        $followeeIds = Follow::where('follower_id', $userId)->lists('followee_id');
        $activities = Activity::with('user')->whereIn('user_id', $followeeIds)->get();

        return $activities;
    }

    public function setActivity($data)
    {
        $this->user_id = $data['userId'];
        $this->lesson_id = $data['lessonId'];
        $this->activity = $data['activity'];
        $this->type = $data['type'];
        $this->save();
    }
}
