<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table = 'questions';
    protected $fillable = [
        'value',
        'quiz_id',
    ];

    public function quiz() {
        return $this->belongsTo('App\Quiz' , 'quiz_id');
    }

    public function answers() {
        return $this->hasMany('App\Answer','question_id');
    }

}
