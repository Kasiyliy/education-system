<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonPart extends Model
{
    protected $table = 'lesson_parts';

    protected $fillable = [
        'presentation',
        'lesson_id',
        'audio',
        'video',
        'seconds',
        'completed',
    ];

    public function lesson() {
        return $this->belongsTo('App\Lesson','lesson_id');
    }
}
