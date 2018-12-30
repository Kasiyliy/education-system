<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use SoftDeletes;
    
    protected $dates = ['created_at'];
    protected $table = 'exams';
    protected $fillable = [
        'department_id',
        'subject_id',
        'students_id',
        'quiz',
        'raw_score',
        'percentage',
        'weight',
        'percentage_x_weight',
    ];

    public function subject() {
        return $this->belongsTo('App\Subject','subject_id');
    }
    public function student() {
        return $this->belongsTo('App\Student','students_id');
    }
}
