<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $table = 'quiz_results';
    protected $fillable = ['student_id','quiz_id', 'percentage',];

    public function student()
    {
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function quiz()
    {
        return $this->belongsTo('App\Quiz', 'quiz_id');
    }
}
