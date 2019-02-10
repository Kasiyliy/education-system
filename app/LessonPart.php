<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonPart extends Model
{
    use SoftDeletes;
    protected $table = 'lesson_parts';

    protected $fillable = [
        'presentation',
        'information',
        'lesson_id',
        'audio',
        'video',
        'seconds',
        'completed',
    ];

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($lessonPart) {
            if($lessonPart->presentation){
                if(file_exists($lessonPart->presentation)){
                    unlink($lessonPart->presentation);
                }
            }

            if($lessonPart->audio){
                if(file_exists($lessonPart->audio)){
                    unlink($lessonPart->audio);
                }
            }

            if($lessonPart->video){
                if(file_exists($lessonPart->video)){
                    unlink($lessonPart->video);
                }
            }
        });
    }

    public function lesson() {
        return $this->belongsTo('App\Lesson','lesson_id');
    }
}
