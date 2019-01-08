<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at','updated_at','deleted_at'];
    protected $table = 'quizes';
    protected $fillable = [
        'name',
        'description',
        'subject_id',
        'deleted_at',
    ];

    public function subject() {
        return $this->belongsTo('App\Subject','subject_id');
    }

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }

    public function questions() {
        return $this->hasMany('App\Question','quiz_id');
    }

    public function quizResults() {
        return $this->hasMany('App\QuizResult','quiz_id');
    }

}
