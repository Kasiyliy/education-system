<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at','updated_at','deleted_at'];
    protected $table = 'lessons';

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($lesson) {
            $lesson->lessonParts()->delete();
        });
    }

    protected $fillable = [
        'name',
        'description',
        'subject_id',
        'deleted_at',
    ];

    public function subject() {
        return $this->belongsTo('App\Subject','subject_id');
    }

    public function lessonParts() {
        return $this->hasMany('App\LessonPart','lesson_id');
    }
}
