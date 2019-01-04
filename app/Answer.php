<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    protected $dates = ['created_at','updated_at'];
    protected $table = 'answers';
    protected $fillable = [
        'value',
        'question_id',
        'right',
    ];

    public function question() {
        return $this->belongsTo('App\Question');
    }
}
