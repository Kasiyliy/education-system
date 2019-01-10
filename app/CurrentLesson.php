<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentLesson extends Model
{
    protected $fillable = ['user_id' ,'lesson_id'];


    public function lessonPart() {
        return $this->belongsTo('App\LessonPart','lesson_part_id');
    }

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }
}
